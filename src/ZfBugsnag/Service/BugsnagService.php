<?php
namespace ZfBugsnag\Service;

use \Bugsnag;

class BugsnagService
{
    protected $options;

    /**
     * __construct
     * Send the options of the Bugsnag
     *
     * @param Object \ZfBugsnag\Options\BugsnagOptions
     */
    public function __construct(\ZfBugsnag\Options\BugsnagOptions $options) 
    {
        $this->options = $options;
    }

    /**
     * sendException
     * Send the Exception to the Bugsnag Servers 
     * 
     * @param object \Exception $e
     */
    public function sendException(\Exception $e)
    {
        // Check if we have to send the Exception
        if($this->options->getEnabled())
        {
            // Bugsnag
            $bugsnag        = new \Bugsnag_Client($this->options->getApiKey());
            $bugsnag->setReleaseStage($this->options->getReleaseStage());
            $bugsnag->setNotifyReleaseStages($this->options->getNotifyReleaseStages());
            $bugsnag->setNotifier([
                'name'    =>    'ZfBugsnag',
                'version' =>    \ZfBugsnag\Version::VERSION,
                'url'     =>    'https://github.com/nickurt/zf-bugsnag'
            ]);
            $bugsnag->setAppVersion(\ZfBugsnag\Version::VERSION);
            $bugsnag->setAutoNotify($this->options->getAutoNotify());
            $bugsnag->setSendEnvironment($this->options->getSendEnvironment());

            // Set the handler for the exceptions
            set_error_handler(array($bugsnag, 'errorHandler'));
            set_exception_handler(array($bugsnag, 'exceptionHandler'));

            // Send it
            $bugsnag->notifyException($e);
        }
    }
}