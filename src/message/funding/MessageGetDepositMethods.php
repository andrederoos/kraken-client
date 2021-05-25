<?php
namespace KrakenClient\message\funding;

use GuzzleHttp\Psr7\Request;
use KrakenClient\message\Message;
use KrakenClient\object\HttpMethod;

/**
 * Retrieve methods available for depositing a particular asset.
 */
class MessageGetDepositMethods extends Message
{
    /**
     * Message path.
     */
    public const PATH_DEPOSIT_METHODS = '/%s/private/DepositMethods';

    /**
     * Field constants.
     */
    private const FIELD_ASSET = 'asset';

    /**
     * @param bool $exendedResponse
     */
    public function __construct(string $asset, string $version = '0')
    {
        parent::__construct($version);

        $this->body[self::FIELD_ASSET] = $asset;
        $this->body[self::FIELD_NONCE] = $this->generateNonce();
    }

    /**
     * @return Request
     */
    public function generateRequest(): Request
    {
        return new Request(HttpMethod::POST, vsprintf(self::PATH_DEPOSIT_METHODS, [$this->version]) . $this->generateQueryParameters(), [], http_build_query($this->body, '', '&'));
    }
}