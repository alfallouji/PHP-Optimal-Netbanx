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
 * File:        Settlement.php
 * Project:     PHP-Optimal-Netbanx
 *
 * @author      Al-Fallouji Bashar
 * 
 * Settlement service
 */
class Settlement extends Base
{
    /**
     * Definition of services exposed for Settlement
     * Refer to https://developer.optimalpayments.com/en/documentation/card-payments-api/api/ 
     * @var array
     */
    protected $_services = array(
        // Get a settlement
        'get' => array(
            'method' => 'GET',
            'url' => '/settlements/{ID}',
            'params' => array(
                'id'
            ),
        ),

        // Cancel a settlement
        'cancel' => array(
            'method' => 'PUT',
            'url' => '/settlements/{ID}',
            'params' => array(
                'id',
                'payload'
            ),
        ),
    );
}
