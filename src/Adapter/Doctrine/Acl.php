<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 16:09
 */

namespace Acl\Adapter\Doctrine;


use Acl\AclInterface;

class Acl implements AclInterface {

    protected $userId;
    protected $userRole;

    public function __construct($userId) {
        $this->userId = $userId;
    }

    private function loadAcl() {

    }


    /**
     * @param array $resources map of resourceAlias => privileges for checking
     * @return bool
     */
    public function isAllowed($resources) {
        // TODO: Implement isAllowed() method.
    }

    /**
     * @return int|null
     */
    public function getUserId() {
        // TODO: Implement getUserId() method.
    }

    /**
     * Method asks to refresh ACL configuration from storage. ACL should be refreshed immediately if it's forced
     * @param bool $force
     */
    public function refresh($force = false) {
        // TODO: Implement refresh() method.
    }
}