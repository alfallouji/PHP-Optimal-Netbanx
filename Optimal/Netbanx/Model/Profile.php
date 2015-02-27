<?php
namespace Optimal\Netbanx\Model;

/**
 * Profile model
 */
class Profile extends Base
{
    /**
     * Bag properties definition 
     * @var array
     */
    protected $_fields = array(
        'firstName' => 'string',
        'lastName' => 'string',        
        'email' => 'string',
    );
}
