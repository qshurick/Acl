<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 18:49
 */

namespace Acl;


use Zend\Cache\Storage\StorageInterface;
use Zend\Cache\StorageFactory;

class AdapterOptions {

    /** @var StorageInterface */
    protected $cacheStorage;

    public function __construct($options = array()) {
        if (is_array($options)) {
            if (isset($options['cache'])) {
                $this->setCacheStorage(StorageFactory::factory($options['cache']));
            }
        }
    }

    /**
     * @param \Zend\Cache\Storage\StorageInterface $cacheStorage
     */
    public function setCacheStorage($cacheStorage) {
        $this->cacheStorage = $cacheStorage;
    }

    /**
     * @return \Zend\Cache\Storage\StorageInterface
     */
    public function getCacheStorage() {
        return $this->cacheStorage;
    }

    /**
     * @return bool
     */
    public function isCached() {
        return $this->cacheStorage !== null;
    }

} 