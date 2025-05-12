<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('painel.usuario.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('painel.usuario.edit', compact('user'));
    }
}
