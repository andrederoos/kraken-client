<?php
namespace KrakenClient\message\data;

use GuzzleHttp\Psr7\Request;
use KrakenClient\message\Message;
use KrakenClient\object\HttpMethod;

/**
 * Retrieve all cash balances, net of pending withdrawals.
 */
class MessageGetAccountBalances extends Message
{
    /**
     * Message path.
     */
    public const PATH_BALANCE = '/%s/private/Balance';

    /**
     * @param bool $exendedResponse
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
        return new Request(HttpMethod::POST, vsprintf(self::PATH_BALANCE, [$this->version]) . $this->generateQueryParameters(), [], http_build_query($this->body, '', '&'));
    }
}