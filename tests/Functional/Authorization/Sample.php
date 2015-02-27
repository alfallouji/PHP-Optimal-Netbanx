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
 * Authorization Functionnal test
 */
$baseDir = __DIR__ . '/../../../';

require($baseDir . 'Optimal/Netbanx/Client/Http.php');
require($baseDir . 'Optimal/Netbanx/Service/Base.php');
require($baseDir . 'Optimal/Netbanx/Service/Authorization.php');
require($baseDir . 'Optimal/Netbanx/Model/Base.php');
require($baseDir . 'Optimal/Netbanx/Model/Authorization.php');
require($baseDir . 'Optimal/Netbanx/Model/Card.php');
require($baseDir . 'Optimal/Netbanx/Model/BillingDetails.php');
require($baseDir . 'Optimal/Netbanx/Model/CardExpiry.php');

$auth = new \Optimal\Netbanx\Model\Authorization();
$auth->merchantRefNum = 'refNum_' . uniqid();
$auth->amount = 1000 + rand(200, 3000);
$auth->settleWithAuth = 'true';

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

$result = $authClient->create($auth);
echo PHP_EOL . PHP_EOL;
print_r($result['result']);

$result = $authClient->get($result['result']['id']);
echo PHP_EOL . PHP_EOL;
print_r($result);
