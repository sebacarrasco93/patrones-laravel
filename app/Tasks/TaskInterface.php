<?php

namespace App\Tasks;

use Closure;

interface TaskInterface
{
    public function handle($request, Closure $next);
}
