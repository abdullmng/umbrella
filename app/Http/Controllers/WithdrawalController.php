<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WithdrawalController extends Controller
{
    public function withdraw(Request $request)
    {
        $config = app('settings');
        $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required'
        ]);

        $type = $request->type;
        $user = auth()->user();
        $user_id = auth()->id();

        if (!$user->has_bank)
        {
            return back()->withErrors(['error' => 'You do not have an active bank account']);
        }

        if ($config['allow_withdrawal'] == 'false')
        {
            return back()->withErrors(['error' => 'Withdrawal is not active at the moment']);
        }

        switch ($type) {
            case 'activity':
                if ($request->amount < $config['min_withdrawal_amount_activity'])
                {
                    return back()->withErrors(['error' => 'Minimum withdrawal amount from activity earnings is '.$config['min_withdrawal_amount_activity']]);
                }
                if ($request->amount > $user->activity_bal)
                {
                    return back()->withErrors(['error' => 'You do not have enough balance from selected account']);
                }
                break;
            case 'sales':
                if ($request->amount < $config['min_withdrawal_amount_referral'])
                {
                    return back()->withErrors(['error' => 'Minimum withdrawal amount from sales earnings is NGN '.$config['min_withdrawal_amount_referral']]);
                }
                if ($request->amount > $user->referral_bal)
                {
                    return back()->withErrors(['error' => 'You do not have enough balance from selected account']);
                }
                break;
            default:
                return back()->withErrors(['error' => 'unknown withdrawal request type']);
                break;
        }

        $check = Withdrawal::where('user_id', $user_id)->where('type', $type)->where('status', 'pending')->exists();
        if ($check)
        {
            return back()->withErrors(['error' => 'You already have a pending withdrawal, kindly wait for a response']);
        }

        $details = [
            "account_bank" => explode('-', $user->bank)[0],
            "account_number" => $user->account_number,
            "amount" => $request->amount,
            "narration" => "Umbrella Groups Sales Commission",
            "currency" => "NGN",
            "reference" => $this->generateTransactionReference(),
            "callback_url" => "https://webhook.site/b3e505b0-fe02-430e-a538-22bbbce8ce0d",
            "debit_currency" => "NGN"
        ];
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. env('FLUTTERWAVE_SECRET')
        ];
        $response = Http::withHeaders($headers)->post('https://api.flutterwave.com/v3/transfers', $details)->json();
        dd($response);
        Withdrawal::create([
            'user_id' => $user_id,
            'amount' => $request->amount,
            'type' => $type,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Withdrawal successful');
    }

    public function generateTransactionReference()
    {
        return date("ymdhis");
    }
}
