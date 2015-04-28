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
 * File:        Enrollment.php
 * Project:     PHP-Optimal-Netbanx
 *
 * @author      Al-Fallouji Bashar
 * 
 * Enrollment service
 */
class Enrollment extends Base
{
    /**
     * Definition of services exposed for Enrollment
     * Refer to https://developer.optimalpayments.com/en/documentation/3d-secure-api/overview
     * @var array
     */
    protected $_services = array(
        // Create an enrollment
        'create' => array(
            'method' => 'POST',
            'url' => '/enrollmentchecks',
            'params' => array(
                'payload'
            ),
        ),

        // Get an enrollment
        'get' => array(
            'method' => 'GET',
            'url' => '/enrollmentchecks/{ID}',
            'params' => array(
                'id',
            ),
        ),
    );
}
