<?php

declare(strict_types=1);

use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\Persistence\Mapping\Driver\MappingDriverChain;
use DoctrineMongoODMModule\Service\DoctrineObjectHydratorFactory;

return [
    'doctrine' => [
        'connection' => [
            'odm_default' => [
                'server'           => 'localhost',
                'port'             => '27017',
                'connectionString' => null,
                'user'             => null,
                'password'         => null,
                'dbname'           => null,
                'options'          => [],
            ],
        ],

        'configuration' => [
            'odm_default' => [
                'metadata_cache'     => 'array',

                'driver'             => 'odm_default',

                'generate_proxies'   => Configuration::AUTOGENERATE_EVAL,
                'proxy_dir'          => 'data/DoctrineMongoODMModule/Proxy',
                'proxy_namespace'    => 'DoctrineMongoODMModule\Proxy',

                'generate_hydrators' => Configuration::AUTOGENERATE_ALWAYS,
                'hydrator_dir'       => 'data/DoctrineMongoODMModule/Hydrator',
                'hydrator_namespace' => 'DoctrineMongoODMModule\Hydrator',

                'generate_persistent_collections' => Configuration::AUTOGENERATE_ALWAYS,
                'persistent_collection_dir' => 'data/DoctrineMongoODMModule/PersistentCollection',
                'persistent_collection_namespace' => 'DoctrineMongoODMModule\PersistentCollection',
                'persistent_collection_factory' => null,
                'persistent_collection_generator' => null,

                'default_db'         => null,

                'filters'            => [],  // array('filterName' => 'BSON\Filter\Class')

                // custom types
                'types'              => [],

                //'classMetadataFactoryName' => 'ClassName'
            ],
        ],

        'driver' => [
            'odm_default' => [
                'class'   => MappingDriverChain::class,
                'drivers' => [],
            ],
        ],

        'documentmanager' => [
            'odm_default' => [
                'connection'    => 'odm_default',
                'configuration' => 'odm_default',
                'eventmanager' => 'odm_default',
            ],
        ],

        'eventmanager' => [
            'odm_default' => [
                'subscribers' => [],
            ],
        ],

        'mongo_logger_collector' => [
            'odm_default' => [],
        ],

        'authentication' => [
            'odm_default' => [
                'objectManager' => 'doctrine.documentmanager.odm_default',
                'identityClass' => 'Application\Model\User',
                'identityProperty' => 'username',
                'credentialProperty' => 'password',
            ],
        ],
    ],

    'hydrators' => [
        'factories' => [
            'Doctrine\Laminas\Hydrator\DoctrineObject' => DoctrineObjectHydratorFactory::class,
        ],
    ],

    // laminas/laminas-developer-tools specific settings

    'view_manager' => [
        'template_map' => [
            'laminas-developer-tools/toolbar/doctrine-odm'
                => __DIR__ . '/../view/laminas-developer-tools/toolbar/doctrine-odm.phtml',
        ],
    ],

    'laminas-developer-tools' => [
        'profiler' => [
            'collectors' => ['odm_default' => 'doctrine.mongo_logger_collector.odm_default'],
        ],
        'toolbar' => [
            'entries' => ['odm_default' => 'laminas-developer-tools/toolbar/doctrine-odm'],
        ],
    ],
];
