<?php
namespace Kitpages\MobileAppBuilderBundle\Tests;

use Kitpages\MobileAppBuilderBundle\Processor\Generic\RemoveDirectory;

class RemoveDirectoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->exampleDir = realpath(__DIR__."/../../app/example");
    }
    public function testRemoveDir()
    {
        $buildDir = $this->exampleDir.'/buildDir';
        $fileName = $buildDir.'/test.txt';
        if (!is_dir($buildDir)) {
            mkdir($buildDir);
            mkdir($buildDir.'/subdir');
            touch($buildDir.'/subdir/file.txt');
        }
        touch($fileName);
        $this->assertTrue(is_dir($buildDir));
        $processor = new RemoveDirectory();
        $processor->setParameter("dir", $fileName);
        $this->assertFalse($processor->execute());
        $this->assertTrue(is_file($fileName));


        $processor->setParameter("dir", $buildDir);
        $this->assertTrue($processor->execute());
        $this->assertFalse(is_dir($buildDir));
    }
}