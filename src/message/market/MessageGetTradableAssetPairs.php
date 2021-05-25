<?php
namespace KrakenClient\message\market;

use GuzzleHttp\Psr7\Request;
use KrakenClient\message\Message;
use KrakenClient\object\HttpMethod;

/**
 * Get tradable asset pairs.
 */
class MessageGetTradableAssetPairs extends Message
{
    /**
     * Message path.
     */
    public const PATH_TRADABLE_ASSET = '/%s/public/AssetPairs';

    /** */
    private const FIELD_PAIR = 'pair';
    private const FIELD_INFO = 'info';

    /**
     * @param string $pair
     * @param string $info
     * @param string $version
     */
    public function __construct(string $pair, string $info = 'info', string $version = '0')
    {
        parent::__construct($version);

        $this->body[self::FIELD_PAIR] = $pair;
        $this->body[self::FIELD_INFO] = $info;
    }

    /**
     * @return Request
     */
    public function generateRequest(): Request
    {
        return new Request(HttpMethod::GET, vsprintf(self::PATH_TRADABLE_ASSET, [$this->version]) . $this->generateQueryParameters(), [], http_build_query($this->body, '', '&'));
    }
}