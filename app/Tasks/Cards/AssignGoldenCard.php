<?php

namespace App\Tasks\Cards;

use App\Tasks\TaskInterface;
use Closure;

class AssignGoldenCard implements TaskInterface
{
    public function handle($request, Closure $next)
    {
        if ($request->balance >= 100 && $request->balance <= 200) {
            return $request->credit_card = 'Golden';
        }

        return $next($request);
    }
}
