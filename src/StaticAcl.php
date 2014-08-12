<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 12.08.14
 * Time: 9:00
 */

namespace Acl;


class StaticAcl {
    /** @var AclInterface */
    protected static $instance;
    public static function init(AclInterface $acl) {
        if (static::$instance)
            throw new \Exception(__CLASS__ . " already initialized");
        static::$instance = $acl;
    }
    public static function getInstance() {
        if (!static::$instance)
            throw new \Exception(__CLASS__ . " wasn't initialized");
        return static::$instance;
    }
} 