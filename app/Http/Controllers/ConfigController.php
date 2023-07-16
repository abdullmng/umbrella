<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function save(Request $request)
    {
        $names = $request->names;
        $values = $request->values;

        $count = count($names);

        for($i = 0; $i< $count; $i++)
        {
            $name = $names[$i];
            $value = $values[$i];
            Config::where('name', $name)->update(['value' => $value]);
        }
        return back()->with("success", "Settings saved");
    }
}
