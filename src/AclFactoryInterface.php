<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 9:19
 */

namespace Acl;


interface AclFactoryInterface {

    /**
     * @param array $config
     */
    public function setConfig(array $config);

    /**
     * @return AclInterface
     */
    public function getAcl();

    /**
     * @return InstallationAclInterface
     */
    public function getInstallationAcl();
} 