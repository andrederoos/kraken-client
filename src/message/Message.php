<?php
namespace KrakenClient\message;

use GuzzleHttp\Psr7\Request;

abstract class Message
{
    /**
     * String constants.
     */
    private const EMPTY_STRING = '';
    private const QUERY_START_STRING = '?';

    /**
     * Field parameters.
     */
    protected const FIELD_NONCE = 'nonce';
    
    /**
     * @var string
     */
    protected $version;
    
    /**
     * @var array
     */
    protected $queryParameters = [];

    /**
     * @var array
     */
    protected $body = [];

    /**
     * @var int
     */
    protected $nonce = null;

    /**
     * @return Request
     */
    abstract public function generateRequest(): Request;

    /**
     * @param bool $exendedResponse
     */
    public function __construct(string $version = '0')
    {
        $this->version = $version;
    }

    /**
     * @return int|null
     */
    public function getNonceOrNull()
    {
        if (isset($this->body[self::FIELD_NONCE])) {
            return $this->body[self::FIELD_NONCE];
        } else {
            return null;
        }
    }

    /**
     * @return string
     */
    protected function generateQueryParameters(): string
    {
        if (empty($this->queryParameters)) {
            return self::EMPTY_STRING;
        } else {
            return self::QUERY_START_STRING . http_build_query($this->queryParameters);
        }
    }
    
    /**
     * @return int
     */
    protected function generateNonce(): int {
        $nonce = explode(' ', microtime());

        return  $nonce[1] . str_pad(substr($nonce[0], 2, 6), 6, '0');
    }
}