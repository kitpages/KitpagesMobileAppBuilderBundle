<?php
namespace Kitpages\MobileAppBuilderBundle\Tests;

use Kitpages\MobileAppBuilderBundle\Processor\Generic\UnixCommand;

class UnixCommandTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->exampleDir = realpath(__DIR__."/../../app/example");
    }
    public function testUnixCommand()
    {
        $fileName = $this->exampleDir.'/test.tmp';
        touch($fileName);

        $event = $this->getMock('\Kitpages\ChainBundle\Processor\ProcessorEvent');

        $processor = new UnixCommand();
        $processor->setParameter("chdir", $this->exampleDir);
        $processor->setParameter("command", "ls {{fileName}} {{gloubi}}");
        $processor->setParameter("fileName", "test.tmp");
        $return = $processor->execute($event);

        $this->assertContains("test.tmp", $return);
        unlink($fileName);
        try {
            $return = $processor->execute($event);
            $this->fail("No such file or directory");
        } catch (\RuntimeException $e) {
            $this->assertTrue(true);
        }
    }
}