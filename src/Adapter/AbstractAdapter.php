<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 20:52
 */

namespace Acl\Adapter;


abstract class AbstractAdapter implements AdapterInterface {
    /** @var AdapterOptions */
    protected $options;

    /**
     * @param \Acl\AdapterOptions|array $options
     * @throws \Acl\Exception\RuntimeException
     */
    public function setOptions($options) {
        if ($options instanceof \Acl\AdapterOptions)
            $this->options = $options;
        elseif (is_array($options))
            $this->options = new \Acl\AdapterOptions($options);
        else
            throw new \Acl\Exception\RuntimeException("Bad adapter options");
    }

    /**
     * @return \Acl\AdapterOptions
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @param string $roleName
     * @param array $resources list of $resourceName => array( $privilegeName1, $privilegeName2, ... )
     * @return bool
     */
    public function isAllowed($roleName, $resources) {
        $hash = $this->getHashForQuery($roleName, $resources);

        if ($this->getOptions()->isCached()) {
            $storage = $this->getOptions()->getCacheStorage();
            if ($storage->hasItem($hash))
                return $storage->getItem($hash);
        }

        $result = $this->_isAllowed($roleName, $resources);

        if ($this->getOptions()->isCached()) {
            $storage = $this->getOptions()->getCacheStorage();
            $storage->setItem($hash, $result);
        }

        return $result;
    }

    /**
     * Refresh cached data, in case cache is using
     * @param bool $force
     */
    public function refresh($force = false) {

    }


    protected function getHashForQuery($roleName, $resources) {
        return md5($roleName . \Zend\Json\Json::encode($resources));
    }

    abstract protected function _isAllowed($roleName, $resources);


} 