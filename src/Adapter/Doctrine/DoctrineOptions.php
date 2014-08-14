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

    public function __construct($options = array()) {
        if (is_array($options)) {
            if (isset($options['entity_manager'])) {
                $this->setEntityManager($options['entity_manager']);
            }
        }
        parent::__construct($options);
    }

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