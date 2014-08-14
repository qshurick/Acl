<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 19:56
 */

namespace Acl\Adapter;


use Acl\AdapterOptions;
use Acl\Exception\RuntimeException;
use Acl\Exception\RoleNotFoundException;

interface AdapterInterface {
    /**
     * @param AdapterOptions $options
     * @throws RuntimeException
     */
    public function setOptions($options);

    /**
     * @param string $roleName
     * @param array $resources list of $resourceName => array( $privilegeName1, $privilegeName2, ... )
     * @return bool
     */
    public function isAllowed($roleName, $resources);

    /**
     * @param int $userId
     * @return string|bool
     */
    public function getUserRoleById($userId);

    /**
     * Refresh cached data, in case cache is using
     * @param bool $force
     */
    public function refresh($force = false);

    /**
     * @param int $userId
     */
    public function addUser($userId);

    /**
     * @param string    $roleName
     * @param int       $userId
     * @throws RoleNotFoundException
     */
    public function grantRoleToUser($roleName, $userId);
} 