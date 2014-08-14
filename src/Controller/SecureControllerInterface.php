<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 14.08.14
 * Time: 14:28
 */

namespace Acl\Controller;


interface SecureControllerInterface {
    public function getPrivileges();
} 