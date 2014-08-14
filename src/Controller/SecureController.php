<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 14.08.14
 * Time: 14:25
 */

namespace Acl\Controller;


use Zend\Mvc\Controller\AbstractActionController;

class SecureController extends AbstractActionController implements SecureControllerInterface {
    /**
     * Set here all resources and privileges that controller need to work well
     * @var array List $resourceName => array ( $privilegeName1, $privilegeName2, ... )
     */
    protected $privileges = array();

    /**
     * @return array
     */
    public function getPrivileges() {
        return $this->privileges;
    }

} 