<?php
namespace FragosoSoftware\PagarmeSdk\Infrastructure\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class PagarmeApiClient
{
    private $client;
    private $baseUrl;
    private $apiVersion;
    private $apiUrl;
    private $storeAccessToken;

    public function __construct($storeAccessToken = null)
    {
        $this->storeAccessToken = $storeAccessToken;
        $this->baseUrl = getenv('PAGARME_URL') ?: 'https://api.pagar.me/';
        $this->apiVersion = getenv('PAGARME_API_VERSION') ?: 'core/v5';
        $this->apiUrl =  getenv('PAGARME_API_URL') ?: 'https://api.pagar.me/core/v5';
        $this->client = new Client(['base_uri' => $this->baseUrl]);
    }

    public function setStoreAccessToken($storeAccessToken)
    {
        $this->storeAccessToken = $storeAccessToken;
    }

    private function getHeaders()
    {
        return [
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->storeAccessToken . ':'),
        ];
    }

    public function post($endpoint, $data)
    {
        try {
            $response = $this->client->post("{$this->apiUrl}/$endpoint", [
                'headers' => $this->getHeaders(),
                'json' => $data
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) 
        {           
            return $this->handleException($e);
        }
    }

    public function get($endpoint, $query = [])
    {
        try {
            $response = $this->client->get("{$this->apiUrl}/$endpoint", [
                'headers' => $this->getHeaders(),
                'query' => $query
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function put($endpoint, $data)
    {
        try {
            $response = $this->client->put("{$this->apiUrl}/$endpoint", [
                'headers' => $this->getHeaders(),
                'json' => $data
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function delete($endpoint)
    {
        try {
            $response = $this->client->delete("{$this->apiUrl}/$endpoint", [
                'headers' => $this->getHeaders()
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function patch($endpoint, $data)
    {
        try {
            $response = $this->client->patch("{$this->apiUrl}/$endpoint", [
                'headers' => $this->getHeaders(),
                'json' => $data
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }


    private function handleException(RequestException $e)
    {
        if ($e->hasResponse()) {
            $error = json_decode($e->getResponse()->getBody()->getContents(), true);
            throw new \Exception("Pagar.me API Error: " . json_encode($error));
        } else {
            throw new \Exception("Request Error: " . $e->getMessage());
        }
    }
}
