<?php
namespace Optimal\Netbanx\Model;

/**
 * Card model
 */
class Card extends Base
{
    /**
     * Bag properties definition 
     * @var array
     */
    protected $_fields = array(
        'type' => 'string',
        'cardNum' => 'string',
        'lastDigits' => 'string',
        'cardExpiry' => 'CardExpiry',
        'cvv' => 'string',
        'track1' => 'string',
        'track2' => 'string',
        'paymentToken' => 'string',
    );
}
