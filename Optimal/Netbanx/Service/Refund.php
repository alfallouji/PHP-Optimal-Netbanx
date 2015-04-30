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
namespace Optimal\Netbanx\Service;

/**
 * File:        Refund.php
 * Project:     PHP-Optimal-Netbanx
 *
 * @author      Al-Fallouji Bashar
 * 
 * Refund service
 */
class Refund extends Base
{
    /**
     * Definition of services exposed for Refund
     * Refer to https://developer.optimalpayments.com/en/documentation/card-payments-api/api/ 
     * @var array
     */
    protected $_services = array(
        // Get a refund
        'get' => array(
            'method' => 'GET',
            'url' => '/refunds/{ID}',
            'params' => array(
                'id'
            ),
        ),

        // Cancel a refund
        'cancel' => array(
            'method' => 'PUT',
            'url' => '/refunds/{ID}',
            'params' => array(
                'id',
                'payload'
            ),
        ),

        // Create a refund
        'create' => array(
            'method' => 'POST',
            'url' => '/settlements/{ID}/refunds',
            'params' => array(
                'id',
                'payload'
            ),
        ),

        // Cancel a settlement
        'cancelSettlement' => array(
            'method' => 'PUT',
            'url' => '/settlements/{ID}',
            'params' => array(
                'id',
                'payload',
            ),
        ),
    );
}
