<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $user->changeStatus();

        return redirect()->back()->withSuccess('Se cambió el estado');
    }
}
