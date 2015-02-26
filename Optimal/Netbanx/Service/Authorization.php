<?php
namespace Optimal\Netbanx\Service;

/**
 * Authorization service
 */
class Authorization extends Base
{
    protected $_services = array(
        'create' => array(
            'method' => 'POST',
            'url' => '/auths',
            'params' => array(
                'payload',
            )
        ),
        'get' => array(
            'method' => 'GET',
            'url' => '/auths/{ID}',
            'params' => array(
                'id',
            )
        ),
        'update' => array(
            'method' => 'PUT',
            'url' => '/auths/{ID}',
            'params' => array(
                'id',
                'payload',
            )
        ),
        'reverse' => array(
            'method' => 'POST',
            'url' => '/voidauths/{ID}',
        ),
        'getSettlement' => array(
            'method' => 'GET',
            'url' => '/settlements/{ID}',
        ),
        'cancelSettlement' => array(
            'method' => 'PUT',
            'url' => '/settlements/{ID}',
        ),
    );
}
