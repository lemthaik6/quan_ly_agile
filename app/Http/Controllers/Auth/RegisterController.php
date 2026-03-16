<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'khach_hang';
        $validated['is_active'] = 1;

        $user = User::create($validated);

        Auth::login($user);

        return redirect('/')->with('success', 'Đăng ký thành công!');
    }
}
