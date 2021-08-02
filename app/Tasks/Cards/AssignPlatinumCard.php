<?php

namespace App\Tasks\Cards;

use App\Tasks\TaskInterface;
use Closure;

class AssignPlatinumCard implements TaskInterface
{
    public function handle($request, Closure $next)
    {
        if ($request->balance >= 201 && $request->balance <= 400) {
            return $request->credit_card = 'Platinum';
        }

        return $next($request);
    }
}
