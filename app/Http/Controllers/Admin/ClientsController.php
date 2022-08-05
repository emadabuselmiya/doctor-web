<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $client = Client::when($request->query('name'), function ($query, $name) {
            $query->where('clients.name', 'LIKE', '%' . $name . '%');
        })->orderBy('created_at', 'DESC')
        ->paginate();

        return view('admin.client.index', [
            'clients' => $client,
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
        return view('admin.client.create', [
            'client' => new Client(),
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
            'description' => 'required|min:100',
            'image' => 'required|mimes:png,jpeg,bmp,jpg|max:1024000',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $data['image'] = $image->store('clients', 'images');
        }


        $client = Client::create($data);

        return redirect()
            ->route('admin.clients.index')
            ->with('success', "Client Created");
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
    public function edit(Client $client)
    {
        return view('admin.client.edit', [
            'client' => $client,
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
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|min:100',
            'image' => 'mimes:png,jpeg,bmp,jpg|max:1024000',
        ]);


        $old_image = $client->image;
        $data = $request->except('image');
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $data['image'] = $image->store('clients', 'images');
        }

        $client->update($data);

        if ($old_image && isset($data['image'])) {
            Storage::disk('images')->delete($old_image);
        }
        return redirect()
            ->route('admin.clients.index')
            ->with('success', "Client Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        if ($client->image) {
            Storage::disk('images')->delete($client->image);
        }

        return redirect()
            ->route('admin.clients.index')
            ->with('success', "Client Deleted!");
    }
}
