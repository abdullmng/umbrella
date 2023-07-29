<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Course;
use App\Models\Earning;
use App\Models\User;
use App\Models\UserCourse;
use App\Models\UserSocial;
use App\Models\Withdrawal;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $config;

    public function __construct()
    {
        $this->config = app('settings');
    }

    protected function percentage($amount, $num)
    {
        return $num/100 * $amount;
    }

    public function login()
    {
        if (auth()->check())
        {
            return redirect(route('user.dashboard'));
        }
        return view('users.auth.login');
    }

    public function register()
    {
        if (auth()->check())
        {
            return redirect(route('user.dashboard'));
        }
        $course = Course::find($this->config['registration_course']);
        return view('users.auth.register', ['course' => $course]);
    }

    public function authenticate(Request $request)
    {
        if ($this->config['allow_login'] == "true")
        {
            $request->validate([
                'username' => 'required'
            ]);
            $user = User::where('username', $request->username)->orWhere('email', $request->username)->first();

            if (!is_null($user) && Hash::check($request->password, $user->password))
            {
                Auth::login($user);
                return redirect()->intended(route('user.dashboard'));
            }

            return back()->withErrors(['error' => 'Login failed: please check your credentials and try again.']);
        }

        return back()->withErrors(['error' => 'Login is temporarily unavailable']);
    }

    protected function getRef($ref)
    {
        return User::where('username', $ref)->first();
    }

    protected function getCoupon($code)
    {
        return Coupon::where('code', $code)->first();
    }

    public function store(Request $request)
    {
        if ($this->config['allow_registration'] == "true")
        {
            $request->validate([
                'name' => 'required',
                'username' => 'required|alpha_num|unique:users',
                'phone_number' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed',
                'coupon' => 'required'
            ]);

            $config = app('settings');
            $ref = $this->getRef($request->ref);
            $user_info = $request->except('_token', 'ref', 'coupon');
            $code  = $request->coupon;

            $coupon = $this->getCoupon($code);
            $course = Course::find($this->config['registration_course']);

            if (!is_null($coupon) && $coupon->status == 'unused')
            {
                if ($course->amount == $coupon->amount)
                {
                    $ref_id = null;
                    if ($ref)
                    {
                        $ref_id = $ref->id;
                        $ref_com = $this->percentage($coupon->amount, $config['referral_commission']);
                        if ($config['referral_type'] == 'fixed')
                        {
                            $ref_com = $config['referral_commission'];
                        }
                        Earning::create([
                            'user_id' => $ref->id,
                            'amount' => $ref_com,
                            'type' => 'referral_commission',
                            'day' => date('Y-m-d'),
                        ]);

                        $upper_ref = $ref->ref_id;
                        if (!is_null($upper_ref))
                        {
                            $sub_ref_com = $this->percentage($coupon->amount, $config['sub_referral_commission']);
                            if ($config['referral_type'] == 'fixed')
                            {
                                $sub_ref_com = $config['sub_referral_commission'];
                            }
                            Earning::create([
                                'user_id' => $upper_ref,
                                'amount' => $sub_ref_com,
                                'type' => 'referral_commission',
                                'day' => date('Y-m-d'),
                            ]);
                        }
                    }
                    $user_info['ref_id'] = $ref_id;
                    $user = User::create($user_info);
                    $coupon->update([
                        'status' => 'used',
                        'user_id' => $user->id
                    ]);
                    UserCourse::create([
                        'user_id' => $user->id,
                        'course_id' => $course->id,
                        'status' => 'active',
                        'date_activated' => date('Y-m-d'),
                    ]);
                    Auth::login($user);
                    return redirect()->intended(route('user.dashboard'));
                }
                return back()->withErrors(['error' => 'This coupon cannot be used for this activation!']);
            }

            return back()->withErrors(['error' => 'Invalid coupon or already used!']);
        }

        return back()->withErrors(['error' => 'You cannot register an account at the moment.']);
    }

    public function dashboard()
    {
        $user = auth()->user();
        return view('users.dashboard', ['user' => $user]);
    }

    public function bank()
    {
        try
        {
            $banks = Http::withHeaders(['authorization' => 'Bearer '.config('app.flutterwave_secret')])->get('https://api.flutterwave.com/v3/banks/NG')->json();
            return view('users.bank', ['banks' => $banks['data'], 'user' => auth()->user()]);
        }
        catch(ConnectionException $e)
        {
            //dd($e);
            return redirect()->back()->withErrors(["error"=> "Network Error"]);
        }
    }

    public function updateBank(Request $request)
    {
        $request->validate([
            'account_name' => 'required',
            'account_number' => 'required|numeric',
            'bank' => 'required'
        ]);

        $bank_info = $request->except('_token');

        User::where('id', auth()->id())->update($bank_info);
        return back()->with('success', 'Bank Info has been saved');
    }

    public function socials()
    {
        $socials = app('socials');
        return view('users.socials', ['socials' => $socials, 'user' => auth()->user()]);
    }

    public function coupons()
    {
        $vendors = User::where('role', 'vendor')->inRandomOrder()->get();
        return view('users.coupons', ['vendors' => $vendors]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('user.login'));
    }

    public function activities()
    {
        $earnings = auth()->user()->earnings;
        return view('users.activity', ['earnings' => $earnings]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|max:104'
        ]);
        $path = $request->file('image')->store('public/images');
        $user = auth()->user();

        $url = Storage::url($path);
        User::where('id', auth()->id())->update([
            'image' => $url
        ]);
        return back();
    }

    public function withdrawals()
    {
        $user_id = auth()->id();
        $withdrawals = Withdrawal::where('user_id', $user_id)->orderBy('id','DESC')->get();
        return view('users.withdrawals', ['withdrawals' => $withdrawals]);
    }

    public function vendorDashboard()
    {
        $user_id = auth()->id();
        $stats = [
            'total_coupons' => Coupon::where('vendor_id', $user_id)->count(),
            'total_used' => Coupon::where('vendor_id', $user_id)->where('status', 'used')->count(),
            'total_unused' => Coupon::where('vendor_id', $user_id)->where('status', 'unused')->count()
        ];
        $coupons = Coupon::where('vendor_id', $user_id)->orderBy('user_id', 'ASC')->paginate();
        return view('users.vendor_dash', ['coupons' => $coupons, 'stats' => $stats]);
    }

    public function verifySocials()
    {
        $users = UserSocial::select('user_id')->distinct('user_id')->where('status', 'pending')->paginate();
        return view('users.verify_socials', ['users' => $users]);
    }

    public function verifyUserSocials($user_id)
    {
        $user = User::find($user_id);
        $user_socials = UserSocial::where('status', 'pending')->where('user_id', $user_id)->get();

        return view('users.verify_user_socials', ['user' => $user, 'user_socials' => $user_socials]);
    }

    public function approveSocialById($user_social_id)
    {
        UserSocial::where('id', $user_social_id)->update([
            'status' => 'approved'
        ]);
        return back()->with('success', 'Social Account approved');
    }

    public function declineSocialById($user_social_id)
    {
        UserSocial::where('id', $user_social_id)->update([
            'status' => 'declined'
        ]);
        return back()->with('success', 'Social Account declined');
    }
}
