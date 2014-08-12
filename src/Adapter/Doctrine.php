<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 16:08
 */

namespace Acl\Adapter;


use Acl\AclAbstractFactory;
use Acl\AclInterface;
use Acl\InstallationAclInterface;

class Doctrine extends AclAbstractFactory {

    /**
     * @return AclInterface
     */
    public function getAcl() {
        // TODO: Implement getAcl() method.
    }

    /**
     * @return InstallationAclInterface
     */
    public function getInstallationAcl() {
        // TODO: Implement getInstallationAcl() method.
    }
}