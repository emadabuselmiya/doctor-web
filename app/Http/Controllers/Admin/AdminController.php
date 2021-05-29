<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dachoard()
    {
        $contacts = DB::table('contacts')->count();;
        if ($contacts == 0) {
            $con = new Contact();
            $con->save();
        }
        return view('admin.dachboard', [
            'contacts' => Contact::first(),
        ]);
    }


    public function profile(Request $request)
    {
        return view('admin.profile', [
            'request' => $request,
            'user' => $request->user(),
            'contacts' => Contact::first(),

        ]);
    }
}
