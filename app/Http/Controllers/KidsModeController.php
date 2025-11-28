<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KidsModeController extends Controller
{
    public function toggle(Request $request)
    {
        $kidsMode = $request->session()->get('kids_mode', false);
        $request->session()->put('kids_mode', !$kidsMode);

        return back();
    }
}
