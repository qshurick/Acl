<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 10:08
 */

namespace Acl;


use Acl\Adapter\Doctrine;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;

class Module implements
    ConfigProviderInterface,
    InitProviderInterface {

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }


    /**
     * Initialize workflow
     *
     * @param  ModuleManagerInterface $manager
     * @return void
     */
    public function init(ModuleManagerInterface $manager) {
        // TODO: init Acl
    }
}