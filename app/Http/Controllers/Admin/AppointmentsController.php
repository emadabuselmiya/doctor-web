<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Contact;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $appointments = Appointment::when($request->query('name'), function ($query, $name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        })->when($request->query('gender'), function ($query, $gender) {
            $query->where('gender', 'LIKE', '%' . $gender . '%');
        })->orderBy('created_at', 'DESC')
            ->paginate();

        return view('admin.appointment.index', [
            'appointments' => $appointments,
            'filters' => $request->all(),
            'contacts' => Contact::first(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = ['male', 'female'];
        return view('admin.appointment.create', [
            'appointment' => new Appointment(),
            'genders' => $genders,
            'contacts' => Contact::first(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ]);

        Appointment::create($request->all());
        return redirect()
            ->route('admin.appointments.index')
            ->with('success', "Appointment Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        $genders = ['male', 'female'];
        return view('admin.appointment.show', [
            'appointment' => $appointment,
            'genders' => $genders,
            'contacts' => Contact::first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $genders = ['male', 'female'];
        return view('admin.appointment.edit', [
            'appointment' => $appointment,
            'genders' => $genders,
            'contacts' => Contact::first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $appointment->update($request->all());
        return redirect()
            ->route('admin.appointments.index')
            ->with('success', "Appointment Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', "Appointment Deleted!");
    }
}
