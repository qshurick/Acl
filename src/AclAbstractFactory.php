<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 9:27
 */

namespace Acl;


abstract class AclAbstractFactory implements AclFactoryInterface {
    /** @var array */
    protected $config;

    /**
     * @param array $config
     */
    public function setConfig(array $config) {
        $this->config = $config;
    }

} 