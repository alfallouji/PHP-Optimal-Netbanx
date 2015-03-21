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

$auth = new \Optimal\Netbanx\Model\Authorization();
$auth->merchantRefNum = 'refNum_' . uniqid();
$auth->amount = 10000 + rand(200, 3000);
$auth->settleWithAuth = false;

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

$httpClient = new \Optimal\Netbanx\Client\Http($config['apiKey'], $config['apiPassword'], $config['accountId'], 'staging');
$service = new \Optimal\Netbanx\Service\Authorization($httpClient);

// Test 1 - create auth
echo PHP_EOL . 'Testing Authorization creation for ' . $auth->amount;
$result = $service->create($auth);
$id = isset($result['result']['id']) ? $result['result']['id'] : null;
assertTest($id);

// Test 2 - get auth
echo PHP_EOL . 'Testing Authorization get for ' . $id;
$result = $service->get($id);
$getId = isset($result['result']['id']) ? $result['result']['id'] : null;
assertTest($getId && $getId == $id);

// Test 3 - partial reverse of auth
$authReversal = new \Optimal\Netbanx\Model\AuthorizationReversal();
$authReversal->id = $getId;
$authReversal->amount = rand(500, 1000);
$authReversal->merchantRefNum = 'Reverse_for_' . $auth->merchantRefNum;
echo PHP_EOL . 'Testing Authorization reverse for an amount of ' . $authReversal->amount;
$result = $service->reverse($getId, $authReversal);
assertTest(isset($result['result']['status']) && $result['result']['status'] == 'COMPLETED');

// Test 4 - settle authorization
echo PHP_EOL . 'Testing Authorization settlement';
$result = $service->settle($id, array('merchantRefNum' => $auth->merchantRefNum));
assertTest($result['code'] == 200 && isset($result['result']['id']));

// Exit with success return code (for travis) 
exit(0);
