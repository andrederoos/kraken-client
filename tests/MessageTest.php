<?php
namespace KrakenClient\Tests;

use GuzzleHttp\Psr7\Request;
use \PHPUnit\Framework\TestCase;
use KrakenClient\message\MessageGetAccountBalances;

class MessageTest extends TestCase
{
    /**
     */
    public function testAccountBalancesGenerateRequest()
    {
        $message = new MessageGetAccountBalances();

        static::assertInstanceOf(Request::class, $message->generateRequest());
    }
}