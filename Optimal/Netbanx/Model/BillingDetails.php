<?php
namespace Optimal\Netbanx\Model;

/**
 * BillingDetails model
 */
class BillingDetails extends Base
{
    /**
     * Bag properties definition 
     * @var array
     */
    protected $_fields = array(
        'street' => 'string',
        'zip' => 'string',
        'country' => 'string',
        'city' => 'Expiry',
    );
}
