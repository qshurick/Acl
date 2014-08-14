<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 14.08.14
 * Time: 13:14
 */

namespace Acl\Service;


use Acl\Exception\RuntimeException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AclFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $options = $serviceLocator->get('Configuration');
        $options = $options['dao-acl'];
        $adapter = $options['adapter'];
        $options = $options['options'];
        if ($adapter === 'doctrine') {
            if (is_string($options['entity_manager'])) {
                $options['entity_manager'] = $serviceLocator->get($options['entity_manager']);
            }
        }
        try {
            $acl = \Acl\Acl::getInstance($adapter, $options);
            return $acl;
        } catch (RuntimeException $re) {
            $acl = \Acl\Acl::getInstance();
            return $acl;
        }
    }
}