<?php
namespace Avinmedia\ArvancloudApis\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GuzzleClient
{
    protected $client;
    protected $token;

    public function __construct()
    {
        $this->token = config('ArvancloudAPIs.ARVANCLOUD_API_TOKEN');
        $this->client = new Client([
            'base_uri' => config('ArvancloudAPIs.ARVAN_API_URL'),
            'headers' => [
                'Authorization' => $this->token,
                'Accept' => 'application/json',
            ],
        ]);

    }

    public function get($endpoint, array $query = [])
    {
        try {
            $response = $this->client->get($endpoint,[
                'query' => $query,
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function post($endpoint, array $data = [])
    {
        try {
            $response = $this->client->post($endpoint, [
                'json' => $data,
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function delete($endpoint, array $data = [])
    {
        try {
            $response = $this->client->delete($endpoint,[
                'json' => $data,
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function put($endpoint, array $data = [])
    {
        try {
            $response = $this->client->put($endpoint,[
                'json' => $data,
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    public function patch($endpoint, array $data = [])
    {
        try {
            $response = $this->client->patch($endpoint,[
                'json' => $data,
            ]);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return $this->handleException($e);
        }
    }

    protected function handleException(RequestException $e)
    {
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            $statusCode = $response->getStatusCode();
            $errorBody = $response->getBody()->getContents();
            return [
                'error' => true,
                'message' => "HTTP $statusCode: $errorBody",
            ];
        } else {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
