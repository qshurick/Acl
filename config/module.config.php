<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 11:50
 */

return array(

    'dao-acl' => array(
        'adapter' => '\Acl\Adapter\Doctrine',
        /*'cache' => array(
            'cache_adapter' => 'SomeCacheAdapterClass',
            'ttl' => -1
        )*/
    ),

    // necessary for using Doctrine adapter
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
                'paths' => array(__DIR__ . '/../src/Adapter/Doctrine/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Acl\Adapter\Doctrine\Entity' => 'application_entities'
                )
            )
        )
    ),

    'service_manager' => array(
        'aliases' => array(
            'DaoAcl' => 'dao-acl.service.default_factory'
        ),
        'factories' => array(
            'dao-acl.service.default_factory' => new \Acl\Service\AclFactory(),
        )
    ),
    /*'controllers' => array(
        'initializers' => array(
            'Acl\Service\Initializer'
        )
    ),*/
);