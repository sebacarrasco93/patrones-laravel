<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\Commands\Users\UpdateCommand;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        UpdateCommand::new($user, $request->validate([
            'name' => 'required',
        ]))->execute();

        return back()->withSuccess('Nombre actualizado correctamente');
    }
}
