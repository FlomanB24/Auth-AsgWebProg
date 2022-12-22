<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register',[
            'title' => 'register',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:100', 'min:5'],
            'email' => ['required', 'email:dns'],
            'password' => ['required', 'min:5']
        ]);

        // dd('data berhasil ditambahkan');

        // $validatedData['password'] = bcrypt($validatedData['password']);
        // $validatedData['password'] = Hash::make($validatedData['password']);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false
        ]);

        // $request->session()->flash('success', 'Registration success! Please login');

        return redirect('/login');
    }
}
