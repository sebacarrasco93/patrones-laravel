<?php

namespace App\Services\Adapters;

use App\Contracts\VerifiableAdapter;
use Illuminate\Support\Facades\Http;

class AbstractApiAdapter implements VerifiableAdapter
{
    private $client;
    private $response;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://emailvalidation.abstractapi.com');
    }

    public function verify(string $email) : bool
    {
        $this->response = $this->client->get('v1', [
            'api_key' => config('external.api_key_abstractapi'),
            'email' => $email,
        ]);

        return $this->checkResponse();
    }

    public function checkResponse() : bool
    {
        if (isset($this->response['error'])) {
            throw new \Exception('Se produjo un error, revisa si tu API_KEY_ABSTRACTAPI es válida');
        }

        return (bool) $this->response['is_smtp_valid']['value'];
    }
}
