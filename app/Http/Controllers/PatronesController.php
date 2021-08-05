<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatronesController extends Controller
{
    public function factory()
    {
        return view('patrones.factory');
    }

    public function factoryMethod()
    {
        return view('patrones.factory-method');
    }

    public function state()
    {
        $users = \App\Models\User::get();

        return view('patrones.state', compact('users'));
    }

    public function pipeline()
    {
        $users = \App\Models\User::get();

        return view('patrones.pipeline', compact('users'));
    }

    public function adapter()
    {
        $users = \App\Models\User::get();

        return view('patrones.adapter', compact('users'));
    }

    public function command()
    {
        $users = \App\Models\User::get();

        return view('patrones.command', compact('users'));
    }
}
