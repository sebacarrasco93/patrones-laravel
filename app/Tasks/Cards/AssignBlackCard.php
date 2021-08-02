<?php

namespace App\Tasks\Cards;

use App\Tasks\TaskInterface;
use Closure;

class AssignBlackCard implements TaskInterface
{
    public function handle($request, Closure $next)
    {
        if ($request->balance >= 401) {
            return $request->credit_card = 'Black';
        }

        return $next($request);
    }
}
