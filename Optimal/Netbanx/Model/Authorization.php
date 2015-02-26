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
        'card' => '',
    );
   
    public function toArray()
    {
        /** Temporary implementation (just for test class to work) */
        $array = parent::toArray();
        
        $array['card'] = null;
        foreach ($this->card as $k => $v) 
        {
            $array['card'][$k] = $v;
        }
        $array['card']['cardExpiry']['month'] = 11;
        $array['card']['cardExpiry']['year'] = 2019;        
        $array['billingDetails'] = array('street' => '511 rue abelard', 'zip' => 'H3E1B6', 'country' => 'CA', 'city' => 'Verdun',);

        return $array;
    }
}
