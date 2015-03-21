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
 * File:        Authorization.php
 * Project:     PHP-Optimal-Netbanx
 *
 * @author      Al-Fallouji Bashar
 * 
 * Authorization service
 */
class Authorization extends Base
{
    /**
     * Definition of services exposed for Authorization
     * Refer to https://developer.optimalpayments.com/en/documentation/card-payments-api/api/ 
     * @var array
     */
    protected $_services = array(
        // Crate an athorization or purchase
        'create' => array(
            'method' => 'POST',
            'url' => '/auths',
            'params' => array(
                'payload',
            )
        ),

        // Get an authorization
        'get' => array(
            'method' => 'GET',
            'url' => '/auths/{ID}',
            'params' => array(
                'id',
            )
        ),

        // Update an authorization
        'update' => array(
            'method' => 'PUT',
            'url' => '/auths/{ID}',
            'params' => array(
                'id',
                'payload',
            )
        ),

        // Reverse an authorization
        'reverse' => array(
            'method' => 'POST',
            'url' => '/auths/{ID}/voidauths',
            'params' => array(
                'id',
                'payload',
             ),
        ),

        // Settle an authorization
        'settle' => array(
            'method' => 'POST',
            'url' => '/auths/{ID}/settlements',
            'params' => array(
                'id',
                'payload',
            )
        ),

        // Get an authorization reversal
        'getReversal' => array(
            'method' => 'GET',
            'url' => '/voidauths/{ID}',
            'params' => array(
                'id'
            ),
        ),
    );
}
