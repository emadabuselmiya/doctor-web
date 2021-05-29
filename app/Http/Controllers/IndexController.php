<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Doctor;
use App\Models\Gallary;
use App\Models\Message;
use App\Models\Service;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    // Actions

    public function index()
    {
        $contacts = DB::table('contacts')->count();;
        if ($contacts == 0) {
            $con = new Contact();
            $con->save();
        }
        return view('home.index', [
            'sliders' => Slider::where('status', '=', 'active')->paginate(5),
            'services' => Service::paginate(4),
            'doctors' => Doctor::paginate(5),
            'gallaries' => Gallary::where('status', '=', 'active')->paginate(4),
            'contacts' => Contact::first(),
            'clients' => Client::paginate(5),
        ]);
    }

    public function contact()
    {
        $contacts = DB::table('contacts')->count();;
        if ($contacts == 0) {
            $con = new Contact();
            $con->save();
        }
        return view('home.contact', [
            'contacts' => Contact::first(),
            'gallaries' => Gallary::where('status', '=', 'active')->paginate(4),
            'doctors' => Doctor::paginate(5),
        ]);
    }

    public function services()
    {
        $contacts = DB::table('contacts')->count();;
        if ($contacts == 0) {
            $con = new Contact();
            $con->save();
        }
        return view('home.services', [
            'services' => Service::paginate(),
            'contacts' => Contact::first(),
            'gallaries' => Gallary::where('status', '=', 'active')->paginate(4),
            'doctors' => Doctor::paginate(5),

        ]);
    }


    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('home.services', [
            'service' => $service,
            'contacts' => Contact::first(),
            'gallaries' => Gallary::where('status', '=', 'active')->paginate(4),
            'doctors' => Doctor::paginate(5),
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
            'name' => 'required',
            'phone' => 'required|numeric',
            'phone' => 'numeric',
            'email' => 'required|email',
        ]);

        Appointment::create($request->all());
        return redirect()
            ->back()
            ->with('success', "Appointment Created");
    }


}
