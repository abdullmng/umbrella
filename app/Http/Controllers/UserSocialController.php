<?php

namespace App\Http\Controllers;

use App\Models\UserSocial;
use Illuminate\Http\Request;

class UserSocialController extends Controller
{
    public function store(Request $request)
    {
        $sms = $request->social_medias;
        $links = $request->links;

        $count = count($sms);

        for ($x = 0; $x < $count; $x++)
        {
            $social_media = $sms[$x];
            $link = $links[$x];
            $user_id = auth()->id();

            if (is_null($link))
            {
                continue;
            }
            if (UserSocial::where('user_id', $user_id)->where('social_media', $social_media)->where('status', 'approved')->exists())
            {
                continue;
            }
            $socials = [
                'user_id' => $user_id,
                'social_media' => $social_media,
                'link' => $link,
                'status' => 'pending'
            ];

            UserSocial::updateOrCreate(['user_id' => $user_id, 'social_media' => $social_media], $socials);
        }
        return back()->with('success', 'links saved');
    }
}
