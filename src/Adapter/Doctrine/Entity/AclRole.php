<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 16:36
 */

namespace Acl\Adapter\Doctrine\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

/**
 * Class AclRole
 * @package Acl\Adapter\Doctrine\Entity
 * @Entity()
 */
class AclRole {

    const USER_ROLE = 'user';
    const SYSTEM_ROLE = 'system';

    /**
     * @var int
     * @Column(type="integer")
     * @Id()
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     * @Column(type="string")
     */
    protected $name;
    /**
     * @var string
     * @Column(type="string")
     */
    protected $type;

    /**
     * @var AclRole[]
     *
     */
    protected $parents;

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }


} 