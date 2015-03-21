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
 * File:        Base.php
 * Project:     PHP-Optimal-Netbanx
 *
 * @author      Al-Fallouji Bashar
 * 
 * Base parent class for all services
 */
abstract class Base
{
    /**
     * Array containing service definition
     * @var array
     */
    protected $_services = array();

    /** 
     * Netbanx Http Client
     * @var HttpClient
     */
    protected $_httpClient = null;

    /**
     * Class constructor
     * 
     * @param HttpClient $httpClient Netbanx Http client
     */
    public function __construct(\Optimal\Netbanx\Client\Http $httpClient) 
    {
        $this->_httpClient = $httpClient;
    }

    /**
     * Magic method __call
     *
     * @param string $name Name of the method
     * @param array $args Arra of arguments
     * 
     * @return mixed
     * @throws \invalidArgumentException Throws invalid argument exception upon undefined service request
     */
    public function __call($name, $args) 
    {
        if (!isset($this->_services[$name])) 
        {
            throw new \InvalidArgumentException('No service defined for : ' . $name);
        }

        $id = null;
        $payload = array();
        foreach ($this->_services[$name]['params'] as $k => $param)
        {
            switch ($param) 
            {
                case 'id':
                    $id = $args[$k];
                break;

                case 'payload':
                    if (is_object($args[$k]))
                    {
                        $payload = $args[$k]->toArray();
                    }
                    else
                    {
                        $payload = $args[$k];
                    }
                break;
            }
        }

        $url = $this->_httpClient->getUrl() . $this->_services[$name]['url'];
        $url = str_replace('{ID}', $id, $url);
        $methodName = $this->_services[$name]['method'];

        return $this->_httpClient->executeRequest($url, $payload, $methodName);
    }
}
