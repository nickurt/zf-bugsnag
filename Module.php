<?php
namespace ZfBugsnag;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $application        =   $e->getTarget();
        $eventManager       =   $application->getEventManager();
        $services           =   $application->getServiceManager();

        // Check if the module is enabled
        if(!$services->get('ZfBugsnag\Options\BugsnagOptions')->getEnabled())
            return;

        $eventManager->attach('dispatch.error', function ($event) use ($services) {
            $exception          =   $event->getResult()->exception;
            // No exception, stop the script
            if (!$exception) return;

            $service            =   $services->get('BugsnagServiceException');
            $service->sendException($exception);
        });
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'BugsnagServiceException' =>  function($sm) {
                    $options = $sm->get('ZfBugsnag\Options\BugsnagOptions');
                    $service = new \ZfBugsnag\Service\BugsnagService($options);
                    return $service;
                },
            ),
        );
    }
}
