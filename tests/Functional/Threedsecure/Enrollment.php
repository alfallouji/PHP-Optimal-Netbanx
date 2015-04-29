<?php
/**
 * Note : Code is released under the GNU LGPL
 *
 * Please do not change the header of this file
 *
 * This library is free software; you can redistribute it and/or modify it under the terms of the GNU
 * Lesser General Public License as published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * See the GNU Lesser General Public License for more details.
 */

/**
 * File:        Sample.php
 * Project:     PHP-Optimal-Netbanx
 *
 * @author      Al-Fallouji Bashar
 * 
 * Authorization Functional test
 */

/**
 * Helper function for test
 * 
 * @param boolean $v Value to assert
 *
 * @return void
 */
function assertTest($v) 
{
    if ($v)
    {
        echo "\t[OK]" . PHP_EOL;
    }
    else
    {
        echo "\t[FAILED]" . PHP_EOL;
        exit(-1);
    }
}

$baseDir = __DIR__ . '/../../../';
if (getenv('TRAVIS')) 
{
    $config['apiPassword'] = getenv('apiPassword');
    $config['apiKey'] = getenv('apiKey');
    $config['accountId'] = getenv('accountId');
}
else
{
    $config = require($baseDir . 'tests/conf/credentials.php');
}

// Using composer autoloader
require($baseDir . 'vendor/autoload.php');

$enrollment = new \Optimal\Netbanx\Model\EnrollmentLookup();
$enrollment->merchantRefNum = 'refNum_' . uniqid();
$enrollment->amount = 10000 + rand(200, 3000);
$enrollment->currency = 'CAD';
$enrollment->customerIp = '127.0.0.1';
$enrollment->userAgent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36';
$enrollment->acceptHeader = 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8';
$enrollment->merchantUrl = 'http://www.ssense.com';

$card = new \Optimal\Netbanx\Model\Card();
$card->cardNum = '4107857757053670';

$expiry = new \Optimal\Netbanx\Model\CardExpiry();
$expiry->month = 11;
$expiry->year = 2019;

$card->cardExpiry = $expiry;
$enrollment->card = $card;

$httpClient = new \Optimal\Netbanx\Client\Http($config['apiKey'], $config['apiPassword'], $config['accountId'], 'staging');
$httpClient->setWebserviceUrls('https://api.test.netbanx.com/threedsecure/v1/accounts/{ACCOUNT_ID}', 'https://api.netbanx.com/threedsecure/v1/accounts/{ACCOUNT_ID}');
$service = new \Optimal\Netbanx\Service\Enrollment($httpClient);

// Test 1 - do an enrollment lookup
echo PHP_EOL . 'Testing Enrollment lookup for ' . $enrollment->amount . ' using card : ' . $card->cardNum;
$result = $service->create($enrollment);
$status = isset($result['result']['status']) ? $result['result']['status'] == 'COMPLETED' : null;
assertTest($status);

// Test 2 - get an existing enrollment
echo PHP_EOL . 'Getting existing Enrollment for ' . $result['result']['id'];
$result = $service->get($result['result']['id']);
$status = isset($result['result']['status']) ? $result['result']['status'] == 'COMPLETED' : null;
assertTest($status);

// Exit with success return code (for travis) 
exit(0);
