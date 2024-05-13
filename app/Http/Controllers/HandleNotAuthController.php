<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class HandleNotAuthController extends Controller
{
    public function index(Request $request): Response|RedirectResponse
    {
        if ($request->session()->has('no-auth')) {
            return to_route('rooms');
        }

        return Inertia::render('Login');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|alpha_num|max:50'
        ]);

        $request->session()->put('no-auth', [
            'id' => Str::upper(Str::random(6)),
            'username' => $request->username,
        ]);

        return to_route('rooms');
    }
}
