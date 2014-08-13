<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 10:08
 */

namespace Acl;


use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface {

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }


} 