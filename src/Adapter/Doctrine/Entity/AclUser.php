<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 16:32
 */

namespace Acl\Adapter\Doctrine\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * Class AclUser
 * @package Acl\Adapter\Doctrine\Entity
 * @Entity()
 * @Table(name="acl_user")
 */
class AclUser {

    /**
     * @var int
     * @Column(type="integer", name="user_id")
     * @Id()
     */
    protected $userId;
    /**
     * @var int
     * @Column(type="integer", name="role_id")
     */
    protected $roleId;
    /**
     * @var AclRole
     * @OneToOne(targetEntity="AclRole")
     * @JoinColumn(name="role_id", referencedColumnName="id")
     */
    protected $role;

    /**
     * @return AclRole
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * @return int
     */
    public function getRoleId() {
        return $this->roleId;
    }

    /**
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @param int $roleId
     */
    public function setRoleId($roleId) {
        $this->roleId = $roleId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId) {
        $this->userId = $userId;
    }


} 