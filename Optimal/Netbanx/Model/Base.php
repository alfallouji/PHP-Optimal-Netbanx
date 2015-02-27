<?php
namespace Optimal\Netbanx\Model;

/**
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
            return $this->_values[$key];
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
}
