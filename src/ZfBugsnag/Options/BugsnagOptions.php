<?php
namespace ZfBugsnag\Options;

use Zend\Stdlib\AbstractOptions;

class BugsnagOptions extends AbstractOptions
{
    protected $apiKey;

    protected $isEnabled;

    /**
     * setApiKey
     * @param String $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * setEnable
     * @param Boolean $isEnabled
     */
    public function setEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
    }

    /**
     * getApiKey
     * @return String $apiKey
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * getEnabled 
     * @return Boolean $isEnabled
     */
    public function getEnabled()
    {
        return $this->isEnabled;
    }
}