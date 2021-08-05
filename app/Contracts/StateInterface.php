<?php

namespace App\Contracts;

interface StateInterface
{
    public function handle() : void;
}
