<?php
namespace Optimal\Netbanx\Client;

/**
 * Http client to consume Netbanx webservice
 */
class Http
{
    /**
     * HTTP Methods used by OPtimal NetBanx API
     */
    const HTTP_METHOD_GET    = 'GET';
    const HTTP_METHOD_POST   = 'POST';
    const HTTP_METHOD_PUT    = 'PUT';

    /**
     * URL for staging
     * @var string
     */
    private $_stagingUrl = 'https://api.test.netbanx.com/cardpayments/v1/accounts/{ACCOUNT_ID}';

    /**
     * Url for production 
     * @var string
     */
    private $_productionUrl = 'https://api.netbanx.com/cardpayments/v1/accounts/{ACCOUNT_ID}';

    /** 
     * Url of the service
     * @var string
     */
    private $_url = null;

    /**
     * Id of the client
     * @var int
     */
    private $_clientId = null;

    /**
     * Password of the client
     * @var string
     */
    private $_clientPassword = null;

    /**
     * Class constructor
     * 
     * @param int $clientId Client id (api id)
     * @param string $clentPassword Client password (api password)
     * @param int $accountId Account id
     * @param string $mode Can be either staging or production
     */
    public function __construct($clientId, $clientPassword, $accountId, $mode = 'staging')
    {        
        $this->setAccount($accountId, $mode);
        $this->_clientId = $clientId;
        $this->_clientPassword = $clientPassword;
    }

    /**
     * Execute a request (with curl)
     *
     * @param string $url URL
     * @param mixed  $parameters Array of parameters
     * @param string $httpMethod HTTP Method
     * @param array  $httpHeaders HTTP Headers
     * 
     * @return array
     */
    public function executeRequest($url, $parameters = array(), $httpMethod = self::HTTP_METHOD_GET, array $httpHeaders = null)
    {
        $curlOptions = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_CUSTOMREQUEST  => $httpMethod,
            CURLOPT_SSL_VERIFYHOST => false,
        );

        $httpHeaders['Authorization'] = 'Basic ' . base64_encode($this->_clientId .  ':' . $this->_clientPassword);
        $httpHeaders['content-type'] = 'application/json;charset=UTF-8';

        switch($httpMethod) 
        {
            case self::HTTP_METHOD_POST:
                $curlOptions[CURLOPT_POST] = true;

            case self::HTTP_METHOD_PUT:
                $curlOptions[CURLOPT_POSTFIELDS] = json_encode($parameters);
            break;

            case self::HTTP_METHOD_GET:
                if (is_array($parameters)) 
                {
                    $url .= '?' . http_build_query($parameters, null, '&');
                } 
                elseif ($parameters) 
                {
                    $url .= '?' . $parameters;
                }
            break;

            default:
            break;
        }

        $curlOptions[CURLOPT_URL] = $url;
        if (is_array($httpHeaders)) 
        {
            $header = array();
            foreach($httpHeaders as $key => $parsed_urlvalue) 
            {
                $header[] = "$key: $parsed_urlvalue";
            }
            $curlOptions[CURLOPT_HTTPHEADER] = $header;
        }

        $ch = curl_init();
        curl_setopt_array($ch, $curlOptions);

        if (!empty($this->curl_options)) 
        {
            curl_setopt_array($ch, $this->curl_options);
        }
        
        $result = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

        if ($curl_error = curl_error($ch)) 
        {
            throw new Exception($curl_error, Exception::CURL_ERROR);
        } 
        else 
        {
            $json_decode = json_decode($result, true);
        }
        
        curl_close($ch);
        
        return array(
            'result' => (null === $json_decode) ? $result : $json_decode,
            'code' => $http_code,
            'content_type' => $content_type
        );
    }    

    /**
     * Get webservice URL
     * 
     * @return string Webservice URL
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * Set account Id 
     * 
     * @param int $accountId Account id
     * @param string $mode Can be either production or staging
     *
     * @return void
     */
    public function setAccount($accountId, $mode = 'staging') 
    {
        $acceptedModes = array('production', 'staging');
        if (!in_array($mode, $acceptedModes))
        {
            throw new \Exception('Invalid value passed for mode (accepted values are ' . explode(', ', $acceptedModes) . ' : ' . $mode);
        }

        if ('production' == $mode) 
        {
            $this->_url = $this->_productionUrl;
        }
        else 
        {
            $this->_url = $this->_stagingUrl;
        }

        $this->_url = str_replace('{ACCOUNT_ID}', $accountId, $this->_url);
    }

    /**
     * Set the webservice main URL's for prod and staging
     * 
     * @param string $stagingUrl Main URL for staging
     * @param string $productionUrl Main URL for production
     * 
     * @return void
     */
    public function setWebserviceUrls($stagingUrl, $productionUrl)
    {
        $this->_stagingUrl = $stagingUrl;
        $this->_productionUrl = $productionUrl;
    }
}
