<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $messages = Message::when($request->query('name'), function ($query, $name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        })->orderBy('created_at', 'DESC')
            ->paginate();

        return view('admin.message.index', [
            'messages' => $messages,
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
        return view('admin.message.create', [
            'message' => new Message(),
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
            'message' => 'required',
        ]);

        Message::create($request->all());
        return redirect()
            ->route('admin.messages.index')
            ->with('success', "Message Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('admin.message.show', [
            'message' => $message,
            'contacts' => Contact::first(),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        return view('admin.message.edit', [
            'message' => $message,
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
    public function update(Request $request, Message $message)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $message->update($request->all());
        return redirect()
            ->route('admin.messages.index')
            ->with('success', "Message Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.messages.index')
            ->with('success', "Message Deleted!");
    }
}
