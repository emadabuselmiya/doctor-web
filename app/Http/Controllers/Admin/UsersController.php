<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::when($request->query('name'), function ($query, $name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        })->when($request->query('email'), function ($query, $gender) {
            $query->where('email', 'LIKE', '%' . $gender . '%');
        })->orderBy('created_at', 'DESC')
            ->paginate();

        return view('admin.users.index', [
            'users' => $users,
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
        return view('admin.users.create', [
            'user' => new User(),
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        $data = $request->except('password');

        $data['password'] = Hash::make($request->password);
        User::create($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', "User Created");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
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
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
            'password' => 'string|max:255',
        ]);

        $data = $request->except('password');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()
            ->route('admin.users.index')
            ->with('success', "User Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', "User Deleted!");
    }
}
