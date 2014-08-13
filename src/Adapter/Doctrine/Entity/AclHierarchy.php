<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 16:33
 */

namespace Acl\Adapter\Doctrine\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * Class AclHierarchy
 * @package Acl\Adapter\Doctrine\Entity
 * @Entity()
 * @Table(name="acl_hierarchy")
 */
class AclHierarchy {
    /**
     * @var int
     * @Column(type="integer")
     * @Id()
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var int
     * @Column(type="integer", name="role_id")
     */
    protected $roleId;

    /**
     * @var AclRole[]
     * @Column(type="integer", name="parent_id")
     */
    protected $parentId;


    /**
     * @param \Acl\Adapter\Doctrine\Entity\AclRole[] $parentId
     */
    public function setParentId($parentId) {
        $this->parentId = $parentId;
    }

    /**
     * @param int $roleId
     */
    public function setRoleId($roleId) {
        $this->roleId = $roleId;
    }

    /**
     * @return \Acl\Adapter\Doctrine\Entity\AclRole[]
     */
    public function getParentId() {
        return $this->parentId;
    }

    /**
     * @return int
     */
    public function getRoleId() {
        return $this->roleId;
    }



}