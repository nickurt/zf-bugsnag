<?php
namespace ZfBugsnag\Options;

use Zend\Stdlib\AbstractOptions;

class BugsnagOptions extends AbstractOptions
{
    protected $apiKey;

    protected $isEnabled;

    protected $releaseStage;

    protected $notifyReleaseStages;

    protected $autoNotify;

    protected $sendEnvironment;

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
     * setReleaseStage
     * @param String $releaseStage
     */
    public function setReleaseStage($releaseStage)
    {
        $this->releaseStage = $releaseStage;
    }

    /**
     * setNotifyReleaseStages
     * @param Array $stages
     */
    public function setNotifyReleaseStages($stages)
    {
        $this->notifyReleaseStages = $stages;
    }

    /**
     * setAutoNotify
     * @param Boolean $autoNotify
     */
    public function setAutoNotify($autoNotify)
    {
        $this->autoNotify = (bool) $autoNotify;
    }

    /**
     * sendEnvironment
     * @param Boolean $sendEnvironment
     */
    public function setSendEnvironment($sendEnvironment)
    {
        $this->sendEnvironment = (bool) $sendEnvironment;
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

    /**
     * getReleaseStage
     * @return String $releaseStage
     */
    public function getReleaseStage()
    {
        return $this->releaseStage;
    }

    /**
     * getNotifyReleaseStages
     * @return Array $stages
     */
    public function getNotifyReleaseStages()
    {
        return $this->notifyReleaseStages;
    }

    /**
     * getAutoNotify
     * @return Boolean $autoNotify
     */
    public function getAutoNotify()
    {
        return $this->autoNotify;
    }

    /**
     * getSendEnvironment
     * @return Boolean $sendEnvironment
     */
    public function getSendEnvironment()
    {
        return $this->sendEnvironment;
    }
}