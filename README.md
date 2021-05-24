# kraken-client
REST-api client for Kraken.com

[![Latest Version](https://img.shields.io/github/release/andrederoos/kraken-client.svg?style=flat-square)](https://github.com/andrederoos/kraken-client/releases)
[![Build Status](https://img.shields.io/github/workflow/status/andrederoos/kraken-client/CI?label=ci%20build&style=flat-square)](https://github.com/andrederoos/kraken-client/actions?query=workflow%3ACI)

- Simple interface for executing messages for Kraken REST api
- Abstracts away the underlying signing of requests

```php
$key = 'your-api-key';
$secret = 'your-api-secret';

$client = new \KrakenClient\KrakenClient($key, $secret);
$message = new \KrakenClient\message\MessageGetAccountBalances();
$response = $client->send($message->generateRequest(), $message->getNonceOrNull());

echo $response->getBody();
```

## Help and docs

- [Kraken REST api documentation](https://docs.kraken.com/rest/)

## Installing

The recommended way to install the client is through
[Composer](https://getcomposer.org/).

```bash
composer require andrederoos/kraken-client
```
