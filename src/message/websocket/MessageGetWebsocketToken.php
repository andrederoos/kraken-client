<?php
namespace KrakenClient\message\websocket;

use GuzzleHttp\Psr7\Request;
use KrakenClient\message\Message;
use KrakenClient\object\HttpMethod;

/**
 * Get Websockets Token.
 * Note: The 'Access WebSockets API' permission must be enabled for the API key in order to generate the authentication token.
 */
class MessageGetWebsocketToken extends Message
{
    /**
     * Message path.
     */
    public const PATH_WEBSOCKET_TOKEN = '/%s/private/GetWebSocketsToken';

    /**
     * @param string $version
     */
    public function __construct(string $version = '0')
    {
        parent::__construct($version);

        $this->body[self::FIELD_NONCE] = $this->generateNonce();
    }

    /**
     * @return Request
     */
    public function generateRequest(): Request
    {
        return new Request(HttpMethod::POST, vsprintf(self::PATH_WEBSOCKET_TOKEN, [$this->version]) . $this->generateQueryParameters(), [], http_build_query($this->body, '', '&'));
    }
}