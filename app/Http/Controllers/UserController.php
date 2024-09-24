<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }
}