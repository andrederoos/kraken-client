<?php
namespace KrakenClient;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class KrakenClient
{
    /**
     * Client url and headers.
     */
    private const URL_API = 'https://api.kraken.com';
    private const HEADER_API_KEY = 'API-Key';
    private const HEADER_API_SIGN = 'API-Sign';

    /**
     * Guzzle constants.
     */
    private const FIELD_BASE_URI = 'base_uri';
    private const FIELD_HEADERS = 'headers';
    private const HEADER_CONTENT_TYPE = 'Content-Type';
    private const HEADER_ACCEPT = 'Accept';
    private const VALUE_CONTENT_TYPE_X_FORM = 'application/x-www-form-urlencoded';
    private const VALUE_ACCEPT = '*/*';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $apiSecret;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct(string $apiKey, string $apiSecret)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->client = new Client([self::FIELD_BASE_URI => self::URL_API]);
    }

    /**
     * @param Request $request
     * @param string $nonce
     *
     * @return Response
     */
    public function send(Request $request, string $nonce = null): Response
    {
        $headers = [
            self::FIELD_HEADERS => [
                self::HEADER_ACCEPT => self::VALUE_ACCEPT,
                self::HEADER_API_KEY => $this->apiKey
            ]
        ];

        if (is_null($nonce)) {
            //Not required to sign the request.
        } else {
            $headers[self::FIELD_HEADERS][self::HEADER_API_SIGN] = $this->generateSignature($request, $nonce);
        }

        $headers[self::FIELD_HEADERS][self::HEADER_CONTENT_TYPE] = self::VALUE_CONTENT_TYPE_X_FORM;

        return $this->client->send($request, $headers);
    }

    /**
     * @param Request $request
     * @param string $nonce
     *
     * @return string
     */
    private function generateSignature(Request $request, string $nonce): string
    {
        $path = $request->getUri()->getPath();
        $signature = $path . hash('sha256', $nonce . $request->getBody(), true);
        $signatureHash = hash_hmac('sha512', $signature, base64_decode($this->apiSecret), true);

        return base64_encode($signatureHash);
    }
}