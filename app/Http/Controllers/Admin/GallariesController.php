<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Gallary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GallariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gallaries = Gallary::when($request->query('date'), function ($query, $date) {
            $query->where('Gallaries.created_at', 'LIKE', '%' . $date . '%');
        })->paginate();

        return view('admin.gallary.index', [
            'gallaries' => $gallaries,
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
        $status = ['active', 'inactive'];
        return view('admin.gallary.create', [
            'gallary' => new Gallary(),
            'status' => $status,
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
            'image' => 'required|mimes:png,jpeg,bmp,jpg|max:1024000',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $data['image'] = $image->store('gallaries', 'images');
        }

        $user_id = Auth::id();
        $data['user_id']  = $user_id;
        $gallary = Gallary::create($data);

        return redirect()
            ->route('admin.gallaries.index')
            ->with('success', "Gallary Created!");;
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
    public function edit(Gallary $gallary)
    {
        $status = ['active', 'inactive'];
        return view('admin.gallary.edit', [
            'gallary' => $gallary,
            'status' => $status,
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
    public function update(Request $request, Gallary $gallary)
    {
        $request->validate([
            'image' => 'mimes:png,jpeg,bmp,jpg|max:1024000',
        ]);

        $old_image = $gallary->image;
        $data = $request->except('image');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $data['image'] = $image->store('gallaries', 'images');
        }

        $gallary->update($data);

        if ($old_image && isset($data['image'])) {
            Storage::disk('images')->delete($old_image);
        }
        return redirect()
            ->route('admin.gallaries.index')
            ->with('success', "Gallary Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallary $gallary)
    {
        $gallary->delete();
        if ($gallary->image) {
            Storage::disk('images')->delete($gallary->image);
        }

        return redirect()
            ->route('admin.gallaries.index')
            ->with('success', "Gallary Deleted!");
    }

    public function delete(Request $request)
    {
        $ids = $request->get('ids', []);
        foreach ($ids as $id) {
            $gallary = Gallary::findOrFail($id);
            if ($gallary->image) {
                Storage::disk('images')->delete($gallary->image);
            }
        }
        $ids = DB::delete('delete from gallaries where id in ('.implode(",",$ids).')');


        return redirect()
            ->route('admin.gallaries.index')
            ->with('success', "Gallaries Deleted!");
    }
}
