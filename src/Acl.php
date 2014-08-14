<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 15:19
 */

namespace Acl;


use Acl\Adapter\AdapterInterface;
use Acl\Exception\RoleNotFoundException;
use Acl\Exception\RuntimeException;
use Logger\Logger;
use Logger\LoggerInterface;
use Zend\Debug\Debug;

class Acl {

    const DEFAULT_ROLE = 'guest';

    /** @var Acl */
    protected static $instance;
    /** @var AdapterManager */
    protected static $adapterManager;
    /** @var LoggerInterface */
    protected static $logger;

    /**
     * @param null|AdapterOptions $adapterName
     * @param array $options
     * @throws Exception\RuntimeException
     * @return Acl
     */
    public static function getInstance($adapterName = null, $options = array()) {
        if (static::$instance === null) {
            static::$logger = Logger::getLogger(__CLASS__);
            if ($adapterName instanceof AdapterInterface)
                $adapter = $adapterName;
            else
                $adapter = static::getAdapterManager()->get($adapterName);

            if ($options)
                $adapter->setOptions($options);

            static::$instance = new self($adapter);

            static::$logger->debug("Initialized with options: " . Debug::dump($options, null, false));

        } elseif ($adapterName !== null && static::$instance->getOptions()->getThrowRuntimeExceptions()) {
            static::$logger->error("Acl cannot be initialized twice.");
            throw new RuntimeException("Acl cannot be initialized twice.");
        }
        return static::$instance;
    }


    private static function getAdapterManager() {
        if (static::$adapterManager === null)
            static::$adapterManager = new AdapterManager();
        return static::$adapterManager;
    }

    /** @var AclOptions */
    protected $options;

    /** @var Adapter\AdapterInterface */
    protected $adapter;

    /** @var int */
    protected $currentUserId;
    /** @var string */
    protected $currentUserRole;

    private function __construct($adapter) {
        $this->adapter = $adapter;
        $this->currentUserId = null;
        $this->currentUserRole = static::DEFAULT_ROLE;

        $this->setOptions(array());
    }

    /**
     * @param array|AclOptions $options
     * @throws Exception\RuntimeException
     */
    public function setOptions($options) {
        if ($options instanceof AclOptions) {
            $this->options = $options;
        } elseif (is_array($options)) {
            $this->options = new AclOptions($options);
        } else {
            static::$logger->error("Bad options got");
            static::$logger->debug(Debug::dump($options, "Bad options got", false));
            throw new RuntimeException("Bad options got");
        }
    }

    /**
     * @param \Acl\Adapter\AdapterInterface $adapter
     */
    public function setAdapter($adapter) {
        $this->adapter = $adapter;
    }

    /**
     * @return \Acl\Adapter\AdapterInterface
     */
    public function getAdapter() {
        return $this->adapter;
    }

    /**
     * @param array $resources map of resourceAlias => privileges for checking
     * @return bool
     */
    public function isAllowed($resources) {
        return $this->getAdapter()->isAllowed($this->getCurrentUserRole(), $resources);
    }

    /**
     * @return int|null
     */
    public function getUserId() {
        return $this->currentUserId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId) {
        if ($userId !== $this->currentUserId) {
            static::$logger->debug("User changed '" . $this->currentUserId . "' > '$userId'");
            $this->currentUserId = $userId;
            try {
                $this->setCurrentUserRole($this->getAdapter()->getUserRoleById($userId));
            } catch (\Exception $ex) {
                static::$logger->error($ex);
                $this->setCurrentUserRole(static::DEFAULT_ROLE);
            }
        }
    }

    /**
     * Method asks to refresh ACL configuration from storage. ACL should be refreshed immediately if it's forced
     * @param bool $force
     */
    public function refresh($force = false) {
        $this->getAdapter()->refresh($force);
    }

    /**
     * @return AclOptions
     */
    private function getOptions() {
        return $this->options;
    }

    /**
     * @param string $currentUserRole
     */
    protected function setCurrentUserRole($currentUserRole) {
        static::$logger->debug("Role changed '" . $this->currentUserRole . "' > '$currentUserRole'");
        $this->currentUserRole = $currentUserRole;
    }

    /**
     * @return string
     */
    public function getCurrentUserRole() {
        return $this->currentUserRole;
    }

    /**
     * @param int $userId
     */
    public function addUser($userId) {
        $this->getAdapter()->addUser($userId);
    }

    /**
     * @param string $roleName
     * @param int    $userId
     * @throws RoleNotFoundException
     */
    public function grantRoleToUser($roleName, $userId) {
        $this->getAdapter()->grantRoleToUser($roleName, $userId);
    }

    /**
     * @param string $roleName
     * @param int    $userId
     * @throws RoleNotFoundException
     */
    public function refuseRoleFromUser($roleName, $userId) {
        $this->getAdapter()->refuseRoleFromUser($roleName, $userId);
    }
}