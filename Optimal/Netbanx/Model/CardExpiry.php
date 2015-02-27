<?php
namespace Optimal\Netbanx\Model;

/**
 * CardExpiry model
 */
class CardExpiry extends Base
{
    /**
     * Bag properties definition 
     * @var array
     */
    protected $_fields = array(
        'month' => 'string',
        'year' => 'string',
    );
}
