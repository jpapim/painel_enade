<?php

return [
    'db' => [
        'driver' => 'Pdo',
        'driver_options' =>
            array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '-2:00'"),
        'charset' => 'utf8',
    ],
    'nome_projeto' => 'Controle Smart',
    'slogan' => 'Estoque On-line',
    'tema' => 8,
    'general' => [
        'arquivos' => BASE_PATCH . '/data/arquivos/',
        'cache_sys' => BASE_PATCH . '/data/cache/',
        'cache_css' => BASE_PATCH . '/public/assets/cache/',
    ],
    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'Zend\Cache\Storage\Filesystem' => function($sm) {
                $cache = \Zend\Cache\StorageFactory::factory([
                    'adapter' => [
                        'name' => 'filesystem',
                        'options' => [
                            // tempo de validade do cache
                            'ttl' => 3600,
                            // adicionando o diretorio data/cache para salvar os caches.
                            'cacheDir' => './data/cache'
                        ],
                    ],
                    'plugins' => [
                        'exception_handler' => array('throw_exceptions' => false),
                        'Serializer'
                    ]
                ]);

                return $cache;
            },
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];    