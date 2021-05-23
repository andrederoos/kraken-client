<?php
namespace KrakenClient;

use GuzzleHttp\Client;

class KrakenClient
{
    /**
     * Exception messages.
     */
    private const EXCEPTION_INVALID_METHOD = 'Invalid request method "%s". Expected "%s".';

    /**
     * Client url and headers.
     */
    private const URL_API = 'https://api.kraken.com';
    private const HEADER_API_KEY = 'API-Key';
    private const HEADER_API_SIGN = 'API-Sign';
    private const QUERY_PARAMETER_NONCE = 'nonce';

    /**
     * Guzzle constants.
     */
    private const FIELD_BASE_URI = 'base_uri';
    private const FIELD_HEADERS = 'headers';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $apiSecret;

    /**
     * @var string
     */
    private $version;

    /**
     * @var Client
     */
    private $client;

    public function __construct(string $apiKey, string $apiSecret, string $version = '0')
    {
        
    }

    public function send(Request $request, string $nonce = null)
    {

    }
}