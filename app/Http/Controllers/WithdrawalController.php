<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;

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

        Withdrawal::create([
            'user_id' => $user_id,
            'amount' => $request->amount,
            'type' => $type,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Withdrawal successful');
    }
}
