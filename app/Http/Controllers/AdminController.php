<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //

    public function showSignInForm()
    {
        return view('auth.sign-in');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:user,admin,accountant',
        ]);
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;  // Assignation du rôle
        $user->is_admin = $request->role == 'admin'? true : false;  // Définition de is_admin si admin
    
        $user->save();
    
        return redirect()->route('dashboard')->with('success', 'User added successfully');
    }
    
}
