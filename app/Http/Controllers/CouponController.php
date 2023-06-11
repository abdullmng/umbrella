<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

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
}
