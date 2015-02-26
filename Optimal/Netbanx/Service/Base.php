<?php
namespace Optimal\Netbanx\Service;

abstract class Base
{
    /**
     * Array containing service definition
     * @var array
     */
    protected $_services = array();

    /** 
     * Netbanx Http Client
     * @var HttpClient
     */
    protected $_httpClient = null;

    /**
     * Class constructor
     * 
     * @param HttpClient $httpClient Netbanx Http client
     */
    public function __construct(\Optimal\Netbanx\Client\Http $httpClient) 
    {
        $this->_httpClient = $httpClient;
    }

    /**
     * Magic method __call
     *
     * @param string $name Name of the method
     * @param array $args Arra of arguments
     * 
     * @return mixed
     * @throws \invalidArgumentException Throws invalid argument exception upon undefined service request
     */
    public function __call($name, $args) 
    {
        if (!isset($this->_services[$name])) 
        {
            throw new \InvalidArgumentException('No service defined for : ' . $name);
        }

        $id = null;
        $payload = array();
        foreach ($this->_services[$name]['params'] as $k => $param)
        {
            switch ($param) 
            {
                case 'id':
                    $id = $args[$k];
                break;

                case 'payload':
                    $payload = $args[$k]->toArray();
                break;
            }
        }

        $url = $this->_httpClient->getUrl() . $this->_services[$name]['url'];
        $url = str_replace('{ID}', $id, $url);
        $methodName = $this->_services[$name]['method'];

        return $this->_httpClient->executeRequest($url, $payload, $methodName);
    }
}
