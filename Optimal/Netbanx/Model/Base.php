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
 * File:        Base.php
 * Project:     PHP-Optimal-Netbanx
 *
 * @author      Al-Fallouji Bashar
 * 
 * Abstract base class for all models
 */
abstract class Base
{
    /**
     * Bag value container
     * @var array
     */
    protected $_values = array();

    /**
     * Bag properties definition 
     * @var array
     */
    protected $_fields = array();
   
    /**
     * Magic setter
     * 
     * @param string $key Name of the property
     * @param mixed $value Value of the property
     * 
     * @return void
     * @throw \Exception Upon invalid key, an exception is thrown
     */
    public function __set($key, $value) 
    {
        if (isset($this->_fields[$key]))
        {
            $this->_values[$key] = $value;
        }
        else
        {
            throw new \Exception('Undefined field : ' . $key);
        }
    }

    /**
     * Magic getter
     * 
     * @param string $key Name of the property
     * 
     * @return mixed Value of the property
     * @throw \Exception Upon invalid key, an exception is thrown
     */
    public function __get($key) 
    {
        if (isset($this->_fields[$key])) 
        {
            return isset($this->_values[$key]) ? $this->_values[$key] : null;
        }

        throw new \Exception('Undefined field : ' . $key);
    }

    /**
     * Retrns an assoc array representation of the object
     * 
     * @return array
     */
    public function toArray()
    {
        $array = array();
        foreach ($this->_values as $k => $v) 
        {
            if (is_object($v)) 
            {
                $array[$k] = $v->toArray();
            }
            else
            {
                $array[$k] = $v;
            }
        }

        return $array;
    }

    /**
     * Initialize object from array
     * 
     * @param array $params Assoc array of key value pair
     * 
     * @return void
     */
    public function initFromArray(array $params = array())
    {
        foreach ($params as $k => $v) 
        {
            if (!isset($this->_fields[$k])) 
            {
                continue;
            }

            if (is_array($v)) 
            {
                $className = '\\Optimal\\Netbanx\\Model\\' . $this->_fields[$k];
                $object = new $className();
                $object->initFromArray($v);
                $this->$k = $object;
            }
            else
            {
                $this->$k = $v;
            }
        }
    }
}
