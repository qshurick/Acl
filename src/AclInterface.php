<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 8:55
 */

namespace Acl;

interface AclInterface {

    const DEFAULT_ROLE = 'guest';

    /**
     * @param array $resources map of resourceAlias => privileges for checking
     * @return bool
     */
    public function isAllowed($resources);

    /**
     * @return int|null
     */
    public function getUserId();

    /**
     * Method asks to refresh ACL configuration from storage. ACL should be refreshed immediately if it's forced
     * @param bool $force
     */
    public function refresh($force = false);
} 