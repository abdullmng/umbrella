<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Course;
use App\Models\Earning;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

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
        $banks = Http::withHeaders(['authorization' => 'Bearer '.config('app.flutterwave_secret')])->get('https://api.flutterwave.com/v3/banks/NG')->json();
        return view('users.bank', ['banks' => $banks['data'], 'user' => auth()->user()]);
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
        $vendors = User::where('role', 'vendor')->get();
        return view('users.coupons', ['vendors' => $vendors]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('user.login'));
    }
}
