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
}
