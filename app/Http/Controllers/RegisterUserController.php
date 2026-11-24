<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Role;
use App\Models\User;
use Auth;

class RegisterUserController extends Controller
{
    public function create() {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request) {
        $validated = $request->validated();

        $user = User::create($validated + [
            'role_id' => Role::where('name', 'customer')->value('id'),
        ]);

        Auth::login($user);

        return redirect()->route('welcome')->with('success', 'Registration successful!');
    }
}
