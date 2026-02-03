<?php

namespace App\Services;

use GuzzleHttp\Client;

class PayPalService
{
    protected $client;
    protected $baseUrl;
    protected $clientId;
    protected $secret;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = config('services.paypal.base_uri');
        $this->clientId = config('services.paypal.client_id');
        $this->secret = config('services.paypal.secret');
    }

    public function getAccessToken()
    {
        $response = $this->client->post($this->baseUrl . '/v1/oauth2/token', [
            'auth' => [$this->clientId, $this->secret],
            'form_params' => [
                'grant_type' => 'client_credentials'
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data['access_token'];
    }

    public function createOrder($amount)
    {
        $accessToken = $this->getAccessToken();

        $response = $this->client->post($this->baseUrl . '/v2/checkout/orders', [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $amount,
                    ],
                ]],
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function capturePayment($orderId)
    {
        $accessToken = $this->getAccessToken();

        $response = $this->client->post($this->baseUrl . "/v2/checkout/orders/{$orderId}/capture", [
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
