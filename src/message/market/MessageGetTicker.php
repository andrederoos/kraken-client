<?php
namespace KrakenClient\message\market;

use GuzzleHttp\Psr7\Request;
use KrakenClient\message\Message;
use KrakenClient\object\HttpMethod;

/**
 * Get Ticker Information
 * Note: Today's prices start at midnight UTC
 */
class MessageGetTicker extends Message
{
    /**
     * Message path.
     */
    public const PATH_TICKER = '/%s/public/Ticker';

    /** */
    private const FIELD_PAIR = 'pair';

    /**
     * @param string $pair
     * @param string $version
     */
    public function __construct(string $pair, string $version = '0')
    {
        parent::__construct($version);

        $this->body[self::FIELD_PAIR] = $pair;
    }

    /**
     * @return Request
     */
    public function generateRequest(): Request
    {
        return new Request(HttpMethod::GET, vsprintf(self::PATH_TICKER, [$this->version]) . $this->generateQueryParameters(), [], http_build_query($this->body, '', '&'));
    }
}