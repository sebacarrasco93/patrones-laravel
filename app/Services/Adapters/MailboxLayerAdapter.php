<?php

namespace App\Services\Adapters;

use App\Contracts\VerifiableAdapter;
use Illuminate\Support\Facades\Http;

class MailboxLayerAdapter implements VerifiableAdapter
{
    private $client;
    private $response;

    public function __construct()
    {
        $this->client = Http::baseUrl('http://apilayer.net');
    }

    public function verify(string $email) : bool
    {
        $this->response = $this->client->get('/api/check', [
            'access_key' => config('external.api_key_apilayer'),
            'email' => $email,
            'smtp' => 1,
            'format' => 1,
        ]);

        return $this->checkResponse();
    }

    public function checkResponse() : bool
    {
        if (isset($this->response['error'])) {
            throw new \Exception('Se produjo un error, revisa si tu API_KEY_APILAYER es válida');
        }

        return (bool) $this->response['mx_found'];
    }
}
