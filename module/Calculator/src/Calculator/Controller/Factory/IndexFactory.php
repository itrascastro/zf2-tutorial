<?php
/**
 * xenFramework (http://xenframework.com/)
 *
 * This file is part of the xenframework package.
 *
 * (c) Ismael Trascastro <itrascastro@xenframework.com>
 *
 * @link        http://github.com/xenframework for the canonical source repository
 * @copyright   Copyright (c) xenFramework. (http://xenframework.com)
 * @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Calculator\Controller\Factory;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Calculator\Controller\IndexController as CalculatorController;

class IndexFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // ************** Common Error ******************************************************************************
        // @var $serviceLocator \Zend\Mvc\Controller\ControllerManager
        //
        // The ServiceManager is basically the implementation of the ServiceLocator interface.
        // The reason of having the two is that a user can have their own implementation of the ServiceLocator interface.
        // When you request the ->getServiceManager() it returns you the explicit ServiceManager implementation.
        // By using ->getServiceLocator() you are requesting any implementation of the ServiceLocator interface which
        // can be the implementation by the ServiceManager or your own. But as most of the times there is only the
        // default ServiceManager implementation so you will get the same object.
        //
        // $serviceLocator is not the ServiceManager, it is the ControllerManager and it doesn't know how to retrieve
        // a service
        // We need to call getServiceLocator() method to get the ServiceManager
        // **********************************************************************************************************
        $sm = $serviceLocator->getServiceLocator();
        $model = $sm->get('CalculatorModel');
        return new CalculatorController($model);
    }
}