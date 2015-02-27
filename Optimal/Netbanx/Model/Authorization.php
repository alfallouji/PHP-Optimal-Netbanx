<?php
namespace Optimal\Netbanx\Model;

/**
 * Authorization model
 */
class Authorization extends Base
{
    /**
     * Bag properties definition 
     * @var array
     */
    protected $_fields = array(
        'merchantRefNum' => 'string',
        'amount' => 'string',
        'settleWithAuth' => 'string',
        'card' => 'Card',
        'billingDetails' => 'BillingDetails',
    );
}
