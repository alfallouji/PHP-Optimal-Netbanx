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
namespace Optimal\Netbanx\Model;

/**
 * File:        Authorization.php
 * Project:     PHP-Optimal-Netbanx
 *
 * @author      Al-Fallouji Bashar
 * 
 * Authorization model
 */
class Authorization extends Base
{
    /**
     * Bag properties definition 
     * @var array
     */
    protected $_fields = array(
        'id' => 'string',
        'merchantRefNum' => 'string',
        'amount' => 'string',
        'settleWithAuth' => 'boolean',
        'availableToSettle' => 'string',
        'childAccountNum' => 'string',
        'card' => 'Card',
        'authentication' => 'Authentication',
        'authCode' => 'string',
        'profile' => 'Profile',
        'billingDetails' => 'BillingDetails',
        'shippingDetails' => 'ShippingDetails',
        'recurring' => 'string',
        'customerIp' => 'string',
        'dupCheck' => 'boolean',
        'keywords' => 'array',
        'merchantDescriptor' => 'MerchantDescriptor',
        'accordD' => 'AccordD',
        'description' => 'string',
        'masterPass' => 'MasterPass',
        'txnTime' => 'string',
        'currencyCode' => 'string',
        'avsResonse' => 'string',
        'cvvVerification' => 'string',
        'error' => 'Error',
        'status' => 'string',
        'riskReasonCode' => 'array',
        'acquirerResponse' => 'AcquirerResponse',
        'visaAdditionalAuthData' => 'VisaAdditionalAuthData',
    );
}
