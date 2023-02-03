<?php

namespace Source\Models;

class JueriClient {

    private $http, $apiToken, $clientCode;
    private $apiUrlBase = "https://jueri.com.br/sis/api/v1";

    private $requestHeader = [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ];
    
    public function __construct()
    {
        \Source\Core\Environment::load(__DIR__ . '/../../');
        
        $this->apiToken = getenv("JUERI_API_KEY");
        $this->clientCode = getenv("JUERI_CLIENT_CODE");
        $this->http = new \GuzzleHttp\Client();

        $this->requestHeader = array_merge($this->requestHeader, [
            'Authorization' => "Bearer {$this->apiToken}"
        ]);
    }

    public function listProducts(): array|object
    {
        $response = $this->http->get(
            "{$this->apiUrlBase}/{$this->clientCode}/produto",
            [
                'headers' => $this->requestHeader,
                'query' => [
                    'search'=> '',
                    'page'=> '',
                    'per_page'=> '',
                ],
            ]
        );

        $data = json_decode($response->getBody());
        return $data->data;
    }
}