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
        'merchantRefNum' => '',
        'amount' => '',
        'settleWithAuth' => '',
        'card' => 'Card',
        'billingDetails' => 'BillingDetails',
    );
}
