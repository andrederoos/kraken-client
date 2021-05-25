<?php
namespace KrakenClient\message\market;

use GuzzleHttp\Psr7\Request;
use KrakenClient\message\Message;
use KrakenClient\object\HttpMethod;

/**
 * Get information about the assets that are available for deposit, withdrawal, trading and staking.
 */
class MessageGetAssetInfo extends Message
{
    /**
     * Message path.
     */
    public const PATH_ASSET_INFO = '/%s/public/Assets';

    /** */
    private const FIELD_ASSET = 'asset';
    private const FIELD_ASSET_CLASS = 'aclass';

    /**
     * @param string $version
     */
    public function __construct(string $asset = 'all', string $assetClass = 'currency', string $version = '0')
    {
        parent::__construct($version);

        $this->body[self::FIELD_ASSET] = $asset;
        $this->body[self::FIELD_ASSET_CLASS] = $assetClass;
    }

    /**
     * @return Request
     */
    public function generateRequest(): Request
    {
        return new Request(HttpMethod::GET, vsprintf(self::PATH_ASSET_INFO, [$this->version]) . $this->generateQueryParameters(), [], http_build_query($this->body, '', '&'));
    }
}