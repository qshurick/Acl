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
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

/**
 * Class AclStructure
 * @package Acl\Adapter\Doctrine\Entity
 * @Entity()
 * @Table(name="acl_structure")
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
     * @Column(type="integer", name="role_id")
     */
    protected $roleId;

    /**
     * @var AclRole
     * @ManyToOne(targetEntity="AclRole", inversedBy="structure")
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

}