<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 9:29
 */

namespace Acl\Adapter\Dummy;


use Acl\AclInterface;
use Acl\Exception\InheritedRoleCannotBeDeletedException;
use Acl\Exception\ResourceWithPrivilegesCannotBeDeletedException;
use Acl\InstallationAclInterface;
use string;

class Acl implements AclInterface, InstallationAclInterface {

    /** @var \Zend\Permissions\Acl\Acl */
    protected $acl;
    /** @var int */
    protected $userId;
    protected $userRole;

    public function __construct($userId) {
        $this->userId;
        $this->acl = new \Zend\Permissions\Acl\Acl();
        $this->userRole = 'user-' . $userId;
    }


    /**
     * @param array|null $resources map of resourceAlias => privileges for checking
     * @return bool
     */
    public function isAllowed($resources) {
        if ($resources === null)
            return true;
        if (is_array($resources)) {
            foreach ($resources as $resource => $privileges) {
                if (!is_array($privileges))
                    $privileges = array($privileges);
                foreach ($privileges as $privilege) {
                    if (!$this->acl->isAllowed($this->userRole, $resource, $privilege))
                        return false;
                }
            }
            return true;
        } else {
            return $this->acl->isAllowed($this->userRole, $resources);
        }
    }

    /**
     * @return int|null
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Method asks to refresh ACL configuration from storage. ACL should be refreshed immediately if it's forced
     * @param bool $force
     */
    public function refresh($force = false) {}

    /**
     * @param string $resource
     * @param array $privileges
     * @return bool
     */
    public function ensureResource($resource, array $privileges) {
        try {
            $this->acl->addResource($resource);
            return true;
        } catch (\Zend\Permissions\Acl\Exception\InvalidArgumentException $ex) {
            return true;
        } catch (\Exception $ex) {}
        return false;
    }

    /**
     * Method create role if it wasn't present and adds missed resources and/or privileges
     * @param string $roleName
     * @param array $resources list $resource => array ( $privileges )
     * @return bool
     */
    public function ensureRole($roleName, $resources = array()) {
        $this->acl->addRole($roleName);
        if ($resources === null || !is_array($resources)) {
            return true;
        } else {
            foreach ($resources as $resource => $privileges) {
                if (!is_array($privileges))
                    $privileges = array($privileges);
                foreach ($privileges as $privilege) {
                    $this->acl->allow($roleName, $resource, $privilege);
                }
            }
        }
        return true;
    }

    /**
     * @param string $roleName
     * @param string[] $parentRoles
     * @return bool
     */
    public function inheritRole($roleName, $parentRoles = array()) {
        foreach ($parentRoles as $role) {
            $this->acl->inheritsRole($roleName, $role);
        }
    }

    /**
     * Method works only for existed roles and resources/privileges. If there is a connection it will removed
     * @param string $roleName
     * @param array $resources list $resource => array ( $privileges )
     * @return bool
     */
    public function deletePrivilegesFromRole($roleName, $resources = array()) {
        // TODO: Implement deletePrivilegesFromRole() method.
    }

    /**
     * Method delete privilege from ACL scope, if anywhere this privilege present that ACL rule won't longer work
     * @param string $resource
     * @param string $privilege
     * @return bool
     */
    public function deletePrivilege($resource, $privilege) {
        // TODO: Implement deletePrivilege() method.
    }

    /**
     * Method tries to remove resource, if resource has privilege it will throw an Exception or privileges an be forced to remove
     * @param string $resource
     * @param bool $force
     * @return bool
     * @throws ResourceWithPrivilegesCannotBeDeletedException
     */
    public function deleteResource($resource, $force = false) {
        // TODO: Implement deleteResource() method.
    }

    /**
     * @param string $role
     * @return bool
     * @throws InheritedRoleCannotBeDeletedException
     */
    public function deleteRole($role) {
        // TODO: Implement deleteRole() method.
    }
}