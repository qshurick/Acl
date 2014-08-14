<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 14.08.14
 * Time: 13:23
 */

namespace Acl\Service;


use Acl\Acl;
use Acl\Controller\SecureControllerInterface;
use Acl\Exception\AccessDeniedException;
use Logger\Logger;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Initializer implements InitializerInterface {

    /**
     * Initialize
     *
     * @param $instance
     * @param ServiceLocatorInterface $serviceLocator
     * @throws \Acl\Exception\AccessDeniedException
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator) {
        if ($instance instanceof SecureControllerInterface) {
            /** @var Acl $acl */
            $acl = $serviceLocator->get('dao-acl.service.default_factory');
            /** @var AuthenticationServiceInterface $auth */
            $auth = $serviceLocator->get('dao-auth.service.default_factory');
            if ($auth->hasIdentity())
                $acl->setUserId($auth->getIdentity());
            if (!$acl->isAllowed($instance->getPrivileges())) {
                Logger::getLogger(__CLASS__)->notice("ACL Exception: access denied!");
                throw new AccessDeniedException("Access denied!");
            }
        }
    }
}