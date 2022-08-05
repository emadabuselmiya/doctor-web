<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Doctor;
use App\Models\Gallary;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $services = Service::when($request->query('name'), function ($query, $name) {
            $query->where('services.name', 'LIKE', '%' . $name . '%');
        })->orderBy('created_at', 'DESC')
            ->paginate();


        return view('admin.service.index', [
            'services' => $services,
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
        return view('admin.service.create', [
            'service' => new Service(),
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
            $data['image'] = $image->store('services', 'images');
        }

        $user_id = Auth::id(); // $request->user()->id // Auth::user()->id
        $data['user_id']  = $user_id;
        $service = Service::create($data);

        return redirect()
            ->route('admin.services.index')
            ->with('success', "Service Created");;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.service.edit', [
            'service' => $service,
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
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|min:30',
            'image' => 'mimes:png,jpeg,bmp,jpg|max:1024000',
        ]);

        $old_image = $service->image;
        $data = $request->except('image');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $data['image'] = $image->store('services', 'images');
        }

        $service->update($data);

        if ($old_image && isset($data['image'])) {
            Storage::disk('images')->delete($old_image);
        }
        return redirect()
            ->route('admin.services.index')
            ->with('success', "Service Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        if ($service->image) {
            Storage::disk('images')->delete($service->image);
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', "Service Deleted!");
    }
}
