<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Settings;
use App\Models\Doctor;
use App\Models\Gallary;
use App\Models\Message;
use App\Models\Service;
use App\Models\Slider;
use App\Models\User;
use App\Notifications\AppointmentsAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    // Actions

    public function index()
    {
        $contacts = DB::table('contacts')->count();;
        if ($contacts == 0) {
            $con = new Settings();
            $con->save();
        }
        return view('home.index', [
            'sliders' => Slider::where('status', '=', 'active')->paginate(5),
            'services' => Service::paginate(4),
            'doctors' => Doctor::paginate(5),
            'gallaries' => Gallary::where('status', '=', 'active')->paginate(4),
            'contacts' => Settings::first(),
            'clients' => Client::paginate(5),
            'doctors_all' => Doctor::all(),
        ]);
    }

    public function contact()
    {
        $contacts = DB::table('contacts')->count();;
        if ($contacts == 0) {
            $con = new Settings();
            $con->save();
        }
        return view('home.contact', [
            'contacts' => Settings::first(),
            'gallaries' => Gallary::where('status', '=', 'active')->paginate(4),
            'doctors' => Doctor::paginate(5),
            'doctors_all' => Doctor::all(),

        ]);
    }

    public function services()
    {
        $contacts = DB::table('contacts')->count();;
        if ($contacts == 0) {
            $con = new Settings();
            $con->save();
        }
        return view('home.services', [
            'services' => Service::paginate(),
            'contacts' => Settings::first(),
            'gallaries' => Gallary::where('status', '=', 'active')->paginate(4),
            'doctors' => Doctor::paginate(5),
            'doctors_all' => Doctor::all(),


        ]);
    }


    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('home.services', [
            'service' => $service,
            'contacts' => Settings::first(),
            'gallaries' => Gallary::where('status', '=', 'active')->paginate(4),
            'doctors' => Doctor::paginate(5),
            'doctors_all' => Doctor::all(),

        ]);
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ]);
        Message::create($request->all());
        return redirect()
            ->back()
            ->with('success', "Sending Message");
    }

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'age' => 'required|numeric|max:255',
            'gender' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
        ]);
        $body = "name: " . $request->name . "\n age: " . $request->age . "\n gender: " . $request->gender . "\n Description of the health condition:  " . $request->resone;

        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new \App\Mail\Appointment($body));
        }

        Mail::to($request->email)->send(new \App\Mail\Appointment($body));

        Appointment::create($request->all());
        return redirect()
            ->back()
            ->with('success', "Appointment booked successfully, Check Your Email");
    }


}
