<?php

namespace App\Http\Controllers;

use App\Contracts\VerifiableAdapter;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdapterController extends Controller
{
    public function __invoke(Request $request, VerifiableAdapter $emailVerifier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required'],
        ]);

        if (! $emailVerifier->verify($validated['email'])) {
            return redirect()->back()->withErrors(['El email no es válido']);
        }

        $user = User::create($validated);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->back()->withSuccess('Sesión iniciada correctamente');
    }
}
