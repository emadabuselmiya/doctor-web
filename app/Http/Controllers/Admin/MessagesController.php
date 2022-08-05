<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
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
        return view('admin.message.create', [
            'message' => new Message(),
            'contacts' => Settings::first(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        $message->update(['status' => 1]);


        return view('admin.message.show', [
            'message' => $message,
            'contacts' => Settings::first(),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        return view('admin.message.edit', [
            'message' => $message,
            'contacts' => Settings::first(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
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
     * @param int $id
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
