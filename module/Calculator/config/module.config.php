<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'calculator' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/calculator/',
                    'defaults' => array(
                        'controller' => 'calculator',
                        'action'     => 'index',
                    ),
                ),
            ),
            'calculator-setter-injection' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/calculator-setter-injection/',
                    'defaults' => array(
                        'controller' => 'Calculator\Controller\SetterInjection',
                        'action'     => 'index',
                    ),
                ),
            ),
            'add' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/calculator/add/',
                    'defaults' => array(
                        'controller' => 'calculator',
                        'action'     => 'add',
                    ),
                ),
            ),
            'doAdd' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/calculator/do-add/',
                    'defaults' => array(
                        'controller' => 'calculator',
                        'action'     => 'doAdd',
                    ),
                ),
            ),
            'subtract' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/calculator/subtract/',
                    'defaults' => array(
                        'controller' => 'calculator',
                        'action'     => 'subtract',
                    ),
                ),
            ),
            'multiply' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/calculator/multiply/',
                    'defaults' => array(
                        'controller' => 'calculator',
                        'action'     => 'multiply',
                    ),
                ),
            ),
            'divide' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/calculator/divide/',
                    'defaults' => array(
                        'controller' => 'calculator',
                        'action'     => 'divide',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/calculator',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Calculator\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'invokables' => array(
            'CalculatorModel' => 'Calculator\Model\CalculatorModel',
        ),
    ),
    'translator' => array(
        'locale' => 'es_ES',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            // 'calculator' => 'Calculator\Controller\IndexController',
            'Calculator\Controller\SetterInjection' => 'Calculator\Controller\SetterInjectionController',
        ),
        'factories' => array(
            'calculator' => 'Calculator\Controller\Factory\IndexFactory',
        ),
        'initializers' => array(
            'Calculator\Controller\Initializer\SetterInjectionControllerInitializer',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'Calculator/layout'       => __DIR__ . '/../view/layout/layout.phtml',
            'calculator/index/index'  => __DIR__ . '/../view/calculator/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'partial/menu'            => __DIR__ . '/../view/partial/menu.phtml',
            'partial/form'            => __DIR__ . '/../view/partial/form.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
