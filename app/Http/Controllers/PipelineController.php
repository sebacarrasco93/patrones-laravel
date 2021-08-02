<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PipelineController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $validated = $request->validate(['balance' => 'integer|min:0']);

        $user->update($validated);

        return redirect()->back();
    }
}
