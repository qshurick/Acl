<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 9:03
 */

namespace Acl;

use Acl\Exception\InheritedRoleCannotBeDeletedException;
use Acl\Exception\ResourceWithPrivilegesCannotBeDeletedException;

interface InstallationAclInterface {

    /**
     * @param string    $resource
     * @param array     $privileges
     * @return bool
     */
    public function ensureResource($resource, array $privileges);

    /**
     * Method create role if it wasn't present and adds missed resources and/or privileges
     * @param string    $roleName
     * @param array     $resources list $resource => array ( $privileges )
     * @return bool
     */
    public function ensureRole($roleName, $resources = array());

    /**
     * @param string    $roleName
     * @param string[]  $parentRoles
     * @return bool
     */
    public function inheritRole($roleName, $parentRoles = array());

    /**
     * Method works only for existed roles and resources/privileges. If there is a connection it will removed
     * @param string    $roleName
     * @param array     $resources list $resource => array ( $privileges )
     * @return bool
     */
    public function deletePrivilegesFromRole($roleName, $resources = array());

    /**
     * Method delete privilege from ACL scope, if anywhere this privilege present that ACL rule won't longer work
     * @param string $resource
     * @param string $privilege
     * @return bool
     */
    public function deletePrivilege($resource, $privilege);

    /**
     * Method tries to remove resource, if resource has privilege it will throw an Exception or privileges an be forced to remove
     * @param string    $resource
     * @param bool      $force
     * @return bool
     * @throws ResourceWithPrivilegesCannotBeDeletedException
     */
    public function deleteResource($resource, $force = false);

    /**
     * @param string $role
     * @return bool
     * @throws InheritedRoleCannotBeDeletedException
     */
    public function deleteRole($role);
} 