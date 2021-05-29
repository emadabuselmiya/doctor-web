<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sliders = Slider::when($request->query('date'), function ($query, $date) {
            $query->where('sliders.created_at', 'LIKE', '%' . $date . '%');
        })->paginate();

        return view('admin.slider.index', [
            'sliders' => $sliders,
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
        $status = ['active', 'inactive'];
        return view('admin.slider.create', [
            'slider' => new Slider(),
            'status' => $status,
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
            'image' => 'required|mimes:png,jpeg,bmp,jpg|max:1024000',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $data['image'] = $image->store('sliders', 'images');
        }

        $user_id = Auth::id(); // $request->user()->id // Auth::user()->id
        $data['user_id']  = $user_id;
        $slider = Slider::create($data);

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', "Created Slider");;
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
    public function edit(Slider $slider)
    {
        $status = ['active', 'inactive'];
        return view('admin.slider.edit', [
            'slider' => $slider,
            'status' => $status,
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
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'mimes:png,jpeg,bmp,jpg|max:1024000',
        ]);

        $old_image = $slider->image;
        $data = $request->except('image');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $data['image'] = $image->store('sliders', 'images');
        }

        $slider->update($data);

        if ($old_image && isset($data['image'])) {
            Storage::disk('images')->delete($old_image);
        }
        return redirect()
            ->route('admin.sliders.index')
            ->with('success', "Slider Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        if ($slider->image) {
            Storage::disk('images')->delete($slider->image);
        }

        return redirect()
            ->route('admin.sliders.index')
            ->with('success', "Slider Deleted!");
    }

    public function delete(Request $request)
    {
        $ids = $request->get('ids', []);
        foreach ($ids as $id) {
            $slider = Slider::findOrFail($id);
            if ($slider->image) {
                Storage::disk('images')->delete($slider->image);
            }
        }
        $ids = DB::delete('delete from sliders where id in ('.implode(",",$ids).')');


        return redirect()
            ->route('admin.sliders.index')
            ->with('success', "Sliders Deleted!");
    }
}
