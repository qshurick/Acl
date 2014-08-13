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
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * Class AclHierarchy
 * @package Acl\Adapter\Doctrine\Entity
 * @Entity()
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
     * @Column(type="integer")
     */
    protected $roleId;

    /**
     * @var AclRole
     * @OneToOne(targetEntity="AclRole")
     * @JoinColumn(name="role_id", referencedColumnName="id")
     */
    protected $role;

    /**
     * @var int
     * @Column(type="integer")
     */
    protected $parentId;

        /**
     * @return AclRole
     */
    public function getRole() {
        return $this->role;
    }

} 