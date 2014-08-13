<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 16:08
 */

namespace Acl\Adapter;


use Acl\Adapter\Doctrine\DoctrineOptions;
use Acl\Adapter\Doctrine\Entity\AclRole;
use Acl\Adapter\Doctrine\Entity\AclStructure;
use Acl\Adapter\Doctrine\Entity\AclUser;
use Acl\Exception\RuntimeException;
use Zend\Debug\Debug;
use Zend\Permissions\Acl\Acl;

class Doctrine extends AbstractAdapter {

    /** @var \Zend\Permissions\Acl\Acl */
    protected $acl;
    /** @var string */
    protected $lastRole;
    /** @var \Doctrine\ORM\EntityManager */
    protected $entityManager;

    public function setOptions($options) {
        if (is_array($options))
            $options = new DoctrineOptions($options);
        parent::setOptions($options);
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     * @throws \Acl\Exception\RuntimeException
     */
    protected function getEntityManager() {
        if (!$this->entityManager) {
            /** @var DoctrineOptions $options */
            $options = $this->getOptions();
            if (!$options->getEntityManager())
                throw new RuntimeException("EntityManager not found in DoctrineOptions");
            $this->entityManager = $options->getEntityManager();
        }
        return $this->entityManager;
    }

    /**
     * @param $roleName
     * @param $resources
     * @return bool
     */
    protected function _isAllowed($roleName, $resources) {
        if ($roleName === $this->lastRole) {
            $acl = $this->acl;
        } else {
            $acl = $this->initAclFor($roleName);
            $this->acl = $acl;
            $this->lastRole = $roleName;
        }

        foreach ($resources as $resource => $privileges) {
            foreach ($privileges as $privilege) {
                if (!$acl->isAllowed($roleName, $resource, $privilege))
                    return false;
            }
        }
        return true;
    }

    /**
     * @param int $userId
     * @throws \Acl\Exception\RuntimeException
     * @return string|bool
     */
    public function getUserRoleById($userId) {
        $em = $this->getEntityManager();
        $repo = $em->getRepository('\Acl\Adapter\Doctrine\Entity\AclUser');

        /** @var AclUser $aclUser */
        $aclUser = $repo->findOneBy(array( 'user_id' => $userId ));
        if ($aclUser === null) {
            throw new RuntimeException("User #$userId not found or doesn't have any permission.");
        }
        return $aclUser->getRole()->getName();
    }

    /**
     * @param string $roleName
     * @throws \Acl\Exception\RuntimeException
     * @return \Zend\Permissions\Acl\Acl
     */
    protected function initAclFor($roleName) {
        if ($this->getOptions()->isCached()) {
            $storage = $this->getOptions()->getCacheStorage();
            if ($storage->hasItem($roleName)) {
                static::$logger->debug("Cache used for '$roleName'");
                return $storage->getItem($roleName);
            }
        }

        $em = $this->getEntityManager();
        $repo = $em->getRepository('\Acl\Adapter\Doctrine\Entity\AclRole');

        /** @var AclRole $role */
        $role = $repo->findOneBy(array('name' => $roleName));
        if ($role === null)
            throw new RuntimeException("Role '$roleName' not found");

        $data = $this->grabPrivileges($role);

        static::$logger->debug("Prepare granted privileges: " . Debug::dump($data, null, false));

        $acl = new Acl();
        foreach ($data as $resource => $privileges) {
            foreach ($privileges as $privilege => $stuff) {
                if (is_string($privilege))
                    $acl->allow($role->getName(), $resource, $privilege);
                else
                    $acl->allow($role->getName(), $resource, $stuff);
            }
        }

        if ($this->getOptions()->isCached()) {
            $storage = $this->getOptions()->getCacheStorage();
            $storage->setItem($roleName, $acl);
        }

        return $acl;

    }

    /**
     * @param AclRole $role
     * @return array
     */
    protected function grabPrivileges($role) {
        $privileges = array();
        /** @var AclStructure $structure */
        foreach ($role->getStructure() as $structure) {
            if (!isset($privileges[$structure->getResource()])) {
                $privileges[$structure->getResource()] = array();
            }
            array_push($privileges[$structure->getResource()], $structure->getPrivilege());
        }
        $privileges = array_merge_recursive($privileges, $this->grabParents($role));
        return $privileges;
    }

    /**
     * @param AclRole $role
     * @return array
     */
    protected function grabParents($role) {
        $privileges = array();
        $parents = $role->getParents();
        if ($parents->count() > 0) {
            /** @var AclRole $parent */
            foreach ($parents as $parent) {
                $privileges = array_merge_recursive($privileges, $this->grabPrivileges($parent));
            }
        }
        return $privileges;
    }
}