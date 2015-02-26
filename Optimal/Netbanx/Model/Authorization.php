<?php
namespace Optimal\Netbanx\Model;

class Authorization extends Base
{
    protected $_fields = array(
        'merchantRefNum' => '',
        'amount' => '',
        'settleWithAuth' => '',
        'card' => '',
    );
    /**
    = 'refNum_' . uniqid();
$auth->amount = 1000 + rand(200, 3000);
$auth->settleWithAuth = 'true';

$card = new \StdClass();
$card->cardNum = '4530910000012345';
$card->type = 'VI';
$card->lastDigits = '2345';
$auth->card = $card;
*/
   
    public function toArray()
    {
        foreach ($this as $k => $v)
        {
            $array[$k] = $v;
        }

        $array['card'] = null;
        foreach ($this->card as $k => $v) 
        {
            $array['card'][$k] = $v;
        }

        $array['card']['cardExpiry']['month'] = 11;
        $array['card']['cardExpiry']['year'] = 2019;        
        $array['billingDetails'] = array('street' => '511 rue abelard', 'zip' => 'H3E1B6', 'country' => 'CA', 'city' => 'Verdun',);

        unset($array['_fields']);

        return $array;
    }
}
