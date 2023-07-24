<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNull('approved_at')->paginate();

        return view('users.index', compact('users'));
    }

    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        $user = $user->update(['approved_at' => now()]);

        return redirect()->route('users.index')->with('info', 'User berhasil diapprove');
    }
}
