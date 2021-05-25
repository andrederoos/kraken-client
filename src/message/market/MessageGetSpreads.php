<?php
namespace KrakenClient\message\market;

use GuzzleHttp\Psr7\Request;
use KrakenClient\message\Message;
use KrakenClient\object\HttpMethod;

/**
 * Get Recent Spreads.
 */
class MessageGetSpreads extends Message
{
    /**
     * Message path.
     */
    public const PATH_SPREAD = '/%s/public/Spread';

    /** */
    private const FIELD_PAIR = 'pair';
    private const FIELD_SINCE = 'since';

    /**
     * @param string $pair
     * @param string $since
     * @param string $version
     */
    public function __construct(string $pair, string $since = null, string $version = '0')
    {
        parent::__construct($version);

        $this->body[self::FIELD_PAIR] = $pair;

        if (!is_null($since)) {
            $this->body[self::FIELD_SINCE] = $since;
        }
    }

    /**
     * @return Request
     */
    public function generateRequest(): Request
    {
        return new Request(HttpMethod::GET, vsprintf(self::PATH_SPREAD, [$this->version]) . $this->generateQueryParameters(), [], http_build_query($this->body, '', '&'));
    }
}