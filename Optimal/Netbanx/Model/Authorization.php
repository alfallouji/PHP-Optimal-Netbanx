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
        'id' => 'string',
        'merchantRefNum' => 'string',
        'amount' => 'string',
        'settleWithAuth' => 'boolean',
        'availableToSettle' => 'string',
        'childAccountNum' => 'string',
        'card' => 'Card',
        'authentication' => 'Authentication',
        'authCode' => 'string',
        'profile' => 'Profile',
        'billingDetails' => 'BillingDetails',
        'shippingDetails' => 'ShippingDetails',
        'recurring' => 'string',
        'customerIp' => 'string',
        'dupCheck' => 'boolean',
        'keywords' => 'array',
        'merchantDescriptor' => 'MerchantDescriptor',
        'accordD' => 'AccordD',
        'description' => 'string',
        'masterPass' => 'MasterPass',
        'txnTime' => 'string',
        'currencyCode' => 'string',
        'avsResonse' => 'string',
        'cvvVerification' => 'string',
        'error' => 'Error',
        'status' => 'string',
        'riskReasonCode' => 'array',
        'acquirerResponse' => 'AcquirerResponse',
        'visaAdditionalAuthData' => 'VisaAdditionalAuthData',
    );
}
