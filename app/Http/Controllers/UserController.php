<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::query()->with('channel')->get();
    }

    public function show(User $user)
    {
        return $user->load('channel');
    }
}
