<?php
namespace Kitpages\MobileAppBuilderBundle\Tests\Processor\Generic;

use Kitpages\MobileAppBuilderBundle\Processor\Generic\CopyDirectory;
use Kitpages\MobileAppBuilderBundle\Processor\Generic\UnixCommand;

class CopyDirectoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->exampleDir = realpath(__DIR__."/../../app/example");
    }
    public function testCreateDir()
    {
        $event = $this->getMock('\Kitpages\ChainBundle\Processor\ProcessorEvent');

        $processor = new CopyDirectory();
        $processor->setParameter("src_dir", $this->exampleDir.'/commonSrcDir');
        $processor->setParameter("dest_dir", $this->exampleDir.'/buildDir');
        $processor->execute($event);

        $compareProcessor = new UnixCommand();
        $compareProcessor->setParameter("command", "diff -q {{src_dir}} {{dest_dir}}");
        $compareProcessor->setParameter("src_dir", $processor->getParameter("src_dir"));
        $compareProcessor->setParameter("dest_dir", $processor->getParameter("dest_dir").'/css');
        try {
            $compareProcessor->execute($event);
            $this->fail("directory should be different");
        } catch (\RuntimeException $e) {
            $this->assertTrue(true);
        }
        $compareProcessor->setParameter("dest_dir", $processor->getParameter("dest_dir"));
        try {
            $compareProcessor->execute($event);
            $this->assertTrue(true);
        } catch (\RuntimeException $e) {
            $this->fail("directory should be equals");
        }
    }
}