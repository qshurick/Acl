<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 11:50
 */

return array(

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
);