<?php

return array(
    'db' => array(
        'username' => 'root',
        'password' => '',
        'dsn' => 'mysql:dbname=skeleton;host=localhost',
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'dominio' => 'http://skeleton.dev',
    'smtp_options' => array(
        'no-reply' => array(
            'name' => 'no-reply',
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'connection_class' => 'login', #plain
            'connection_config' => array(
                'ssl' => 'tls',
                'username' => 'email@gmail.com',
                'password' => 'senha'
            ),
        ),
        'contato' => array(
            'name' => 'contato',
            'host' => 'localhost',
            'port' => 25,
            'connection_class' => 'plain',
            'connection_config' => array(
//				'ssl' => 'tls',
                'username' => 'contato@mcnetwork.com.br',
                'password' => 'P@lm&1r@s'
            ),
        ),
    )
);
