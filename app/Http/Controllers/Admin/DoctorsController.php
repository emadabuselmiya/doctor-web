<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctor = Doctor::when($request->query('name'), function ($query, $name) {
            $query->where('doctors.name', 'LIKE', '%' . $name . '%');
        })->orderBy('created_at', 'DESC')
            ->paginate();

        return view('admin.doctor.index', [
            'doctors' => $doctor,
            'filters' => $request->all(),
            'contacts' => Settings::first(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctor.create', [
            'doctor' => new Doctor(),
            'contacts' => Settings::first(),

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
            'description' => 'required|min:30',
            'image' => 'required|mimes:png,jpeg,bmp,jpg|max:1024000',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $data['image'] = $image->store('doctors', 'images');
        }

        $user_id = Auth::id(); // $request->user()->id // Auth::user()->id
        $data['user_id']  = $user_id;
        $doctor = Doctor::create($data);

        return redirect()
            ->route('admin.doctors.index')
            ->with('success', "Doctor Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('admin.doctor.edit', [
            'doctor' => $doctor,
            'contacts' => Settings::first(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|min:30',
            'image' => 'mimes:png,jpeg,bmp,jpg|max:1024000',
        ]);

        $old_image = $doctor->image;
        $data = $request->except('image');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $data['image'] = $image->store('doctors', 'images');
        }

        $doctor->update($data);

        if ($old_image && isset($data['image'])) {
            Storage::disk('images')->delete($old_image);
        }
        return redirect()
            ->route('admin.doctors.index')
            ->with('success', "Doctor Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        if ($doctor->image) {
            Storage::disk('images')->delete($doctor->image);
        }

        return redirect()
            ->route('admin.doctors.index')
            ->with('success', "Doctor Deleted!");
    }
}
