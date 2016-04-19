<?php
namespace ZfBugsnag\Service;

use \Bugsnag;

class BugsnagService
{
    protected $options;
    protected $bugsnag;
    protected $oldErrorHandler;
    protected $oldExceptionHandler;

    /**
     * __construct
     * Send the options of the Bugsnag
     *
     * @param Object \ZfBugsnag\Options\BugsnagOptions
     */
    public function __construct(\ZfBugsnag\Options\BugsnagOptions $options)
    {
        $this->options = $options;

        if($this->options->getEnabled())
        {
            $this->bugsnag        = new \Bugsnag_Client($this->options->getApiKey());
            $this->bugsnag->setReleaseStage($this->options->getReleaseStage());
            $this->bugsnag->setNotifyReleaseStages($this->options->getNotifyReleaseStages());
            $this->bugsnag->setBeforeNotifyFunction([$this, 'beforeNotify']);
            $this->bugsnag->setNotifier([
                'name'    =>    'ZfBugsnag',
                'version' =>    \ZfBugsnag\Version::VERSION,
                'url'     =>    'https://github.com/nickurt/zf-bugsnag'
            ]);
            if($this->options->getAppVersion())
            {
                $this->bugsnag->setAppVersion($this->options->getAppVersion());
            }
            $this->bugsnag->setAutoNotify($this->options->getAutoNotify());
            $this->bugsnag->setSendEnvironment($this->options->getSendEnvironment());
        }
    }

    /**
     * setupErrorHandlers
     * Registers the exception and error handlers with PHP
     *
     */
    public function setupErrorHandlers()
    {
        if($this->options->getEnabled())
        {
            $this->oldErrorHandler     = set_error_handler([$this, 'errorHandler']);
            $this->oldExceptionHandler = set_exception_handler([$this, 'exceptionHandler']);
        }
    }

    /**
     * errorHandler
     * Handles PHP errors and sends them to Bugsnag, will call existing error handler
     * if one was defined, if not, returns error to PHP's native error handling.
     *
     * @param Integer $errno Error number
     * @param String $errsrt Error message
     * @param String $errfile File where error occurred
     * @param Integer $errline Line number where error occurred
     * @param Array $errcontext Error's context
     */
    public function errorHandler($errno, $errstr, $errfile = '', $errline = 0, $errcontext = [])
    {
        try
        {
            $this->bugsnag->errorHandler($errno, $errstr, $errfile, $errline);
        } catch (\Exception $e) {
            // Something wrong in the bugsnag notify call
        }

        if($this->oldErrorHandler)
        {
            return call_user_func($this->oldErrorHandler, $errno, $errstr, $errfile, $errline, $errcontext);
        }

        // Returning false here returns error handling to native PHP error handling
        // which may log the error, or display on screen, depending on environment's config
        return false;
    }

    /**
     * exceptionHandler
     * Handles uncaught Exceptions and sends them to Bugsnag, will call existing exception handler
     * if one was defined, if not, re-throws the exception for PHP to handle, instead of swallowing it.
     *
     * @param object \Exception $exception The exception to pass
     */
    public function exceptionHandler($exception)
    {
        try
        {
            $this->bugsnag->exceptionHandler($exception);
        } catch (\Exception $e) {
            // Something wrong in the bugsnag notify call
        }

        if($this->oldExceptionHandler)
        {
            return call_user_func($this->oldExceptionHandler, $exception);
        }

        // This will still allow the exception to bubble up to PHP's native uncaught
        // exception handling (which will throw a PHP Fatal error since the exception
        // would be uncaught at this point).
        restore_exception_handler();
        throw $exception;
    }

    /**
     * beforeNotify
     * This method is called before notifying Bugsnag and will remove a stack frame if that frame
     * matches this class' error/exception handling methods. This makes sure the errors get grouped
     * better in the BugSnag UI, otherwise they'll all get grouped under either the exception handler
     * or the error handler, depending on which one sent it.
     *
     * @param object \Bugsnag_Error $error The Bugsnag_Error object that BugSnag will pass in
     */
    public function beforeNotify(\Bugsnag_Error $error)
    {
        $firstFrame = $error->stacktrace->frames[0];

        if($firstFrame && ($firstFrame['method'] === get_class() . '::errorHandler' || $firstFrame['method'] === get_class() . '::exceptionHandler'))
        {
            array_splice($error->stacktrace->frames, 0, 1);
        }
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
            // Send it
            $this->bugsnag->notifyException($e);
        }
    }
}
