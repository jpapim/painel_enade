<?php

namespace Estrutura;

return array(
    'router' => array(
        'routes' => array(
            'navegacao' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/:controller[/:action[/:id]]',
                    'defaults' => array(
                        'action' => 'index',
                    ),
                ),
            ),
            'estrutura-home' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route' => '/estrutura[/:controller[/:action[/:id]]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Estrutura\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
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
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Estrutura\Controller\Index' => 'Estrutura\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            
            'layout/1/layout' => __DIR__ . '/../view/layout/1/layout.phtml',
            'layout/2/layout' => __DIR__ . '/../view/layout/2/layout.phtml',
            'layout/3/layout' => __DIR__ . '/../view/layout/3/layout.phtml',            
            'layout/4/layout' => __DIR__ . '/../view/layout/4/layout.phtml',
            'layout/5/layout' => __DIR__ . '/../view/layout/5/layout.phtml',
            'layout/6/layout' => __DIR__ . '/../view/layout/6/layout.phtml',
            'layout/7/layout' => __DIR__ . '/../view/layout/7/layout.phtml',
            'layout/8/layout' => __DIR__ . '/../view/layout/8/layout.phtml',
            'layout/9/layout' => __DIR__ . '/../view/layout/9/layout.phtml',
            'layout/10/layout' => __DIR__ . '/../view/layout/10/layout.phtml',
            'layout/11/layout' => __DIR__ . '/../view/layout/11/layout.phtml',
            'layout/12/layout' => __DIR__ . '/../view/layout/12/layout.phtml',
            'layout/13/layout' => __DIR__ . '/../view/layout/13/layout.phtml',
            'layout/14/layout' => __DIR__ . '/../view/layout/14/layout.phtml',
            'layout/15/layout' => __DIR__ . '/../view/layout/15/layout.phtml',
            'layout/16/layout' => __DIR__ . '/../view/layout/16/layout.phtml',
            'layout/17/layout' => __DIR__ . '/../view/layout/17/layout.phtml',
            'layout/18/layout' => __DIR__ . '/../view/layout/18/layout.phtml',
            'layout/19/layout' => __DIR__ . '/../view/layout/19/layout.phtml',

            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
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
