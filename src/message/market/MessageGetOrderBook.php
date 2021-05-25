<?php
namespace KrakenClient\message\market;

use GuzzleHttp\Psr7\Request;
use KrakenClient\message\Message;
use KrakenClient\object\HttpMethod;

/**
 * Get Order Book.
 */
class MessageGetOrderBook extends Message
{
    /**
     * Message path.
     */
    public const PATH_ORDER_BOOK = '/%s/public/Depth';

    /** */
    private const FIELD_PAIR = 'pair';
    private const FIELD_COUNT = 'count';

    /**
     * @param string $pair
     * @param int $count
     * @param string $version
     */
    public function __construct(string $pair, int $count = 100, string $version = '0')
    {
        parent::__construct($version);

        $this->body[self::FIELD_PAIR] = $pair;
        $this->body[self::FIELD_COUNT] = $count;
    }

    /**
     * @return Request
     */
    public function generateRequest(): Request
    {
        return new Request(HttpMethod::GET, vsprintf(self::PATH_ORDER_BOOK, [$this->version]) . $this->generateQueryParameters(), [], http_build_query($this->body, '', '&'));
    }
}