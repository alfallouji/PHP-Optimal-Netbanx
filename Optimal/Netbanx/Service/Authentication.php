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
 * File:        Authentication.php
 * Project:     PHP-Optimal-Netbanx
 *
 * @author      Al-Fallouji Bashar
 * 
 * Authentication service
 */
class Authentication extends Base
{
    /**
     * Definition of services exposed for Authentication
     * Refer to https://developer.optimalpayments.com/en/documentation/3d-secure-api/
     * @var array
     */
    protected $_services = array(
        // Create an authentication
        'create' => array(
            'method' => 'POST',
            'url' => '/enrollmentchecks/{ID}/authentications',
            'params' => array(
                'id',
                'payload'
            ),
        ),

        // Lookup an authentication
        'get' => array(
            'method' => 'GET',
            'url' => '/authentications/{ID}',
            'params' => array(
                'id',
            ),
        ),
    );
}
