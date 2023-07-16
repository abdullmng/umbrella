<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function check(Request $request)
    {
        $code = $request->coupon;

        $coupon = Coupon::where('code', $code)->first();

        if (is_null($coupon))
        {
            return response(['msg' => 'Coupon is invalid', 'error' => true]);
        }

        if ($coupon->status == 'used')
        {
            return response(['msg' => 'Coupon is valid, but already used', 'error' => true]);
        }

        return response(['msg' => 'Coupon is valid for use', 'error' => false]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'no' => 'required',
            'amount' => 'required',
        ]);

        $coupons = [];
        for ($i = 0; $i<$request->no; $i++)
        {
            $coupons[] = [
                'vendor_id' => $request->vendor_id,
                'code' => $this->generateCode(),
                'amount' => $request->amount,
                'status' => 'unused',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Coupon::insert($coupons);
        return back()->with('success', $request->no. ' coupons generated');
    }

    protected function generateCode()
    {
        return $code = Str::random(10);
    }
}
