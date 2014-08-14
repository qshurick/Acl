<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 9:24
 */

namespace Acl\Adapter;

use Acl\Acl;
use Acl\Exception\RoleNotFoundException;

class Dummy extends \Acl\Adapter\AbstractAdapter {

    protected function _isAllowed($roleName, $resources) {
        return true;
    }

    /**
     * @param int $userId
     * @return string|bool
     */
    public function getUserRoleById($userId) {
        return Acl::DEFAULT_ROLE;
    }

    /**
     * @param int $userId
     */
    public function addUser($userId) { }

    /**
     * @param string $roleName
     * @param int $userId
     * @throws RoleNotFoundException
     */
    public function grantRoleToUser($roleName, $userId) { }
}