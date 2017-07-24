<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Zend\Db\Adapter;


return [
    'service_manager' => [
        'abstract_factories' => [
            \Zend\Db\Adapter\AdapterAbstractServiceFactory::class
        ]
    ],
    'db' => [
        'adapters' => [
            'Application\Db\Adapter' => [
                'driver'   => 'Pdo',
                'dsn'      => 'mysql:dbname=exampleapp;host=localhost',
                'username' => 'exampleapp',
                'password' => 'oq9MiA1r0ic2dNdG'
            ]
        ]
    ]
];
