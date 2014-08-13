<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 21:23
 */

namespace Acl\Adapter\Doctrine;


use Acl\AdapterOptions;

class DoctrineOptions extends AdapterOptions {
    /** @var \Doctrine\ORM\EntityManager */
    protected $entityManager;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return $this
     */
    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
        return $this;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }
} 