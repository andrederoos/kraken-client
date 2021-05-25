<?php
namespace KrakenClient\message\data;

use GuzzleHttp\Psr7\Request;
use KrakenClient\message\Message;
use KrakenClient\object\HttpMethod;

/**
 * Retrieve a summary of collateral balances, margin position valuations, equity and margin level.
 */
class MessageGetTradeBalances extends Message
{
    /**
     * Message path.
     */
    public const PATH_TRADE_BALANCE = '/%s/private/TradeBalance';

    /** */
    private const FIELD_ASSET = 'asset';

    /**
     * @param string $asset
     * @param string $version
     */
    public function __construct(string $asset = 'ZUSD', string $version = '0')
    {
        parent::__construct($version);

        $this->body[self::FIELD_NONCE] = $this->generateNonce();
        $this->body[self::FIELD_ASSET] = $asset;
    }

    /**
     * @return Request
     */
    public function generateRequest(): Request
    {
        return new Request(HttpMethod::POST, vsprintf(self::PATH_TRADE_BALANCE, [$this->version]) . $this->generateQueryParameters(), [], http_build_query($this->body, '', '&'));
    }
}