<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 9:24
 */

namespace Acl\Adapter;


use Acl\AclAbstractFactory;
use Acl\AclInterface;
use Acl\Adapter\Dummy\Acl;
use Acl\InstallationAclInterface;

class Dummy extends AclAbstractFactory {

    protected $acl;

    public function __construct($userId) {
        $this->acl = new Acl($userId);
    }


    /**
     * @return AclInterface
     */
    public function getAcl() {
        return $this->acl;
    }

    /**
     * @return InstallationAclInterface
     */
    public function getInstallationAcl() {
        return $this->acl;
    }
}