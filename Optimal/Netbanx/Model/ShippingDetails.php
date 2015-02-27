<?php
namespace Optimal\Netbanx\Model;

/**
 * ShippingDetails model
 */
class ShippingDetails extends Base
{
    /**
     * Bag properties definition 
     * @var array
     */
    protected $_fields = array(
        'carrier' => 'string',
        'shipMethod' => 'string',
        'recipientName' => 'string',
        'street' => 'string',
        'zip' => 'string',
        'country' => 'string',
        'city' => 'Expiry',
        'state' => 'string',
    );
}
