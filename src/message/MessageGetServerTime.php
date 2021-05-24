<?php
namespace KrakenClient\message;

use GuzzleHttp\Psr7\Request;
use KrakenClient\object\HttpMethod;

/**
 * Get the server's time.
 */
class MessageGetServerTime extends Message
{
    /**
     * Message path.
     */
    public const PATH_TIME = '/%s/public/Time';

    /**
     * @return Request
     */
    public function generateRequest(): Request
    {
        return new Request(HttpMethod::GET, vsprintf(self::PATH_TIME, [$this->version]) . $this->generateQueryParameters(), [], http_build_query($this->body, '', '&'));
    }
}