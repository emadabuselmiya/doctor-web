<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $contacts = DB::table('contacts')->count();;
        if ($contacts == 0) {
            $con = new Settings();
            $con->save();
        }
        return view('admin.dachboard', [
            'contacts' => Settings::first(),
        ]);
    }


    public function profile(Request $request)
    {
        return view('admin.profile', [
            'request' => $request,
            'user' => $request->user(),
            'contacts' => Settings::first(),

        ]);
    }
}
