<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 16:35
 */

namespace Acl\Adapter\Doctrine\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * Class AclStructure
 * @package Acl\Adapter\Doctrine\Entity
 * @Entity()
 */
class AclStructure {
    /**
     * @var int
     * @Column(type="integer")
     * @Id()
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var int
     * @Column(type="integer")
     */
    protected $roleId;
    /**
     * @var AclRole
     * @OneToOne(targetEntity="AclRole", fetch="LAZY", mappedBy="id")
     */
    protected $role;
    /**
     * @var string
     * @Column(type="string")
     */
    protected $resource;
    /**
     * @var string
     * @Column(type="string")
     */
    protected $privilege;

    /**
     * @param string $privilege
     */
    public function setPrivilege($privilege) {
        $this->privilege = $privilege;
    }

    /**
     * @return string
     */
    public function getPrivilege() {
        return $this->privilege;
    }

    /**
     * @param string $resource
     */
    public function setResource($resource) {
        $this->resource = $resource;
    }

    /**
     * @return string
     */
    public function getResource() {
        return $this->resource;
    }

    /**
     * @param int $roleId
     */
    public function setRoleId($roleId) {
        $this->roleId = $roleId;
    }

    /**
     * @return int
     */
    public function getRoleId() {
        return $this->roleId;
    }

    /**
     * @return \Acl\Adapter\Doctrine\Entity\AclRole
     */
    public function getRole() {
        return $this->role;
    }


}