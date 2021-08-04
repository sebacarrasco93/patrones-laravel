<?php

namespace App\Contracts;

interface VerifiableAdapter
{
    public function verify(string $email) : bool;

    public function checkResponse() : bool;
}
