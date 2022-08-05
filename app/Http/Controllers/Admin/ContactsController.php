<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Storage;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Settings $contact)
    {
        $contacts = Settings::all();
        if (!isset($contacts)) {
            $con = new Settings();
            $con->save();
        }
        return view('admin.contact.edit', [
            'contact' => $contact,
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
    public function update(Request $request, Settings $contact)
    {
        $request->validate([
            'email' => 'email',
            'logo' => 'mimes:png,jpeg,bmp,jpg|max:1024000',
            'background' => 'mimes:png,jpeg,bmp,jpg|max:1024000',
        ]);

        $old_logo = $contact->logo;
        $old_background = $contact->background;

        $data = $request->except('logo', 'background');

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $image = $request->file('logo');
            $data['logo'] = $image->store('contacts', 'images');
        }

        if ($request->hasFile('background') && $request->file('background')->isValid()) {
            $image = $request->file('background');
            $data['background'] = $image->store('contacts', 'images');
        }

        $contact->update($data);

        if ($old_logo && isset($data['logo'])) {
            Storage::disk('images')->delete($old_logo);
        }

        if ($old_background && isset($data['background'])) {
            Storage::disk('images')->delete($old_background);
        }

        return redirect()
            ->route('admin.contacts.edit', 1)
            ->with('success', "Info Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
