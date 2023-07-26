<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $users = User::whereNull('approved_at')->where('regency_id', '=', Auth::user()->regency_id)->paginate();
            return view('users.index', compact('users'));
        }elseif(Auth::user()->hasRole('superadmin')){
            $users = User::whereNull('approved_at')->paginate();
            return view('users.index', compact('users'));
        }else {
            return 'Anda tidak punya akses';
        }

    }

    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        $user = $user->update(['approved_at' => now()]);

        return redirect()->route('users.index')->with('info', 'User berhasil diapprove');
    }
}
