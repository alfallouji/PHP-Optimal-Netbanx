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

// Using composer autoloader
require($baseDir . 'vendor/autoload.php');

$auth = new \Optimal\Netbanx\Model\Authorization();
$auth->merchantRefNum = 'refNum_' . uniqid();
$auth->amount = 10000 + rand(200, 3000);
$auth->settleWithAuth = 'false';

$card = new \Optimal\Netbanx\Model\Card();
$card->cardNum = '4530910000012345';
$card->type = 'VI';
$card->lastDigits = '2345';

$expiry = new \Optimal\Netbanx\Model\CardExpiry();
$expiry->month = 11;
$expiry->year = 2019;

$card->cardExpiry = $expiry;
$auth->card = $card;

$billingDetails = new \Optimal\Netbanx\Model\BillingDetails();
$billingDetails->street = '511 rue abelard';
$billingDetails->zip = 'H3E 1B6';
$billingDetails->city = 'Verdun';
$billingDetails->country = 'CA';

$auth->billingDetails = $billingDetails;

$config = require($baseDir . 'tests/conf/credentials.php');
$httpClient = new \Optimal\Netbanx\Client\Http($config['apiKey'], $config['apiPassword'], $config['accountId'], 'staging');
$authClient = new \Optimal\Netbanx\Service\Authorization($httpClient);

// Test 1
echo PHP_EOL . 'Testing Authorization creation';
$result = $authClient->create($auth);
$id = isset($result['result']['id']) ? $result['result']['id'] : null;
assertTest($id);

// Test 2
echo PHP_EOL . 'Testing Authorization get';
$result = $authClient->get($result['result']['id']);
$getId = isset($result['result']['id']) ? $result['result']['id'] : null;
assertTest($getId && $getId == $id);

// Test 3
$authReversal = new \Optimal\Netbanx\Model\AuthorizationReversal();
$authReversal->id = $getId;
$authReversal->amount = 200;
$authReversal->merchantRefNum = 'Refund_for_' . $auth->merchantRefNum;
echo PHP_EOL . 'Reversing Authorization for an amount of ' . $authReversal->amount;
$result = $authClient->reverse($getId, $authReversal);
assertTest(isset($result['result']['status']) && $result['result']['status'] == 'COMPLETED');

exit(0);
