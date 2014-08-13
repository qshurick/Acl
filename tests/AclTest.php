<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 13.08.14
 * Time: 20:29
 */

namespace tests;


use Acl\Acl;
use Acl\AclOptions;

class AclTest extends \PHPUnit_Framework_TestCase {

    public static function setUpBeforeClass() {
        date_default_timezone_set("Europe/Amsterdam");
    }


    public function testAclOptions() {
        $aclOptions = new AclOptions();
        $this->assertNotNull($aclOptions);
    }

    public function testAclOptionsDefaults() {
        $aclOptions = new AclOptions();
        $this->assertTrue($aclOptions->getThrowRuntimeExceptions());
        $adapter = $aclOptions->getAdapter();
        $this->assertTrue(empty($adapter));
    }

    public function testAclOptionsConfigurable() {
        $aclOptions = new AclOptions();
        $aclOptions
            ->setThrowExceptions(false)
            ->setAdapter(new \stdClass());

        $this->assertFalse($aclOptions->getThrowRuntimeExceptions());
        $this->assertEquals(new \stdClass(), $aclOptions->getAdapter());
    }

    public function testStaticAclAccessDoesNotConfigured() {
        $this->setExpectedException('Acl\Exception\RuntimeException');
        Acl::getInstance();
    }

    public function testDummyAclAdapter() {
        $options = array(
            'cache' => array(
                'storage' => '???',
                'options' => array(
                    'ttl' => 300
                )
            )
        );
        $acl = Acl::getInstance('dummy', $options);

        $this->assertNotNull($acl);
        $this->assertTrue($acl->isAllowed(array('test' => 'test')));
    }


}
 