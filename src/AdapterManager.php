<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 18:51
 */

namespace Acl;


use Acl\Adapter\AdapterInterface;
use Acl\Exception\RuntimeException;

class AdapterManager {
    protected $knownAdapters = array(
        'dummy' => '\Acl\Adapter\Dummy',
        'doctrine' => '\Acl\Adapter\Doctrine',
    );

    public function has($adapterName) {
        if (is_string($adapterName)) {
            return isset($this->knownAdapters[$adapterName]);
        }
        return false;
    }

    /**
     * @param string $adapterName
     * @param array|AdapterOptions $options
     * @throws Exception\RuntimeException
     * @return null|string
     */
    public function get($adapterName, $options = array()) {
        if (is_string($adapterName)) {
            if (!$this->has($adapterName))
                throw new RuntimeException("'$adapterName' is unknown ACL adapter");
            $adapter = $this->knownAdapters[$adapterName];
            $adapter = new $adapter();
        } else {
            $adapter = $adapterName;
        }
        /** @var AdapterInterface $adapter */
        if ($this->validate($adapter)) {
            if ($options) {
                $adapter->setOptions($options);
            }
            return $adapter;
        }

        throw new RuntimeException("'$adapterName' is wrong ACL adapter");
    }

    /**
     * @param AdapterInterface|object $adapter
     * @return bool
     */
    public function validate($adapter) {
        return $adapter instanceof AdapterInterface;
    }
} 