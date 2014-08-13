<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 19:14
 */

namespace Acl;


class AclOptions {
    /** @var string|AclInterface  */
    protected $adapter;
    /** @var bool  */
    protected $throwRuntimeExceptions;

    public function __construct($options = array()) {
        $this->adapter = "";
        $this->throwRuntimeExceptions = true;
    }

    /**
     * @param string|AclInterface $adapter
     * @return $this
     */
    public function setAdapter($adapter) {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @return \Acl\AclInterface|string
     */
    public function getAdapter() {
        return $this->adapter;
    }

    /**
     * @return boolean
     */
    public function getThrowRuntimeExceptions() {
        return $this->throwRuntimeExceptions;
    }

    /**
     * @param bool $throwExceptions
     * @return $this
     */
    public function setThrowExceptions($throwExceptions) {
        $this->throwRuntimeExceptions = !!$throwExceptions;
        return $this;
    }
} 