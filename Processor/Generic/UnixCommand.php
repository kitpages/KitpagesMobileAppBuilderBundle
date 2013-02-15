<?php
/**
 * Created by Philippe Le Van.
 * Date: 15/02/13
 */
namespace Kitpages\MobileAppBuilderBundle\Processor\Generic;

use Kitpages\ChainBundle\Processor\ProcessorAbstract;
use Kitpages\ChainBundle\Processor\ProcessorEvent;

use Symfony\Component\Process\Process;

/**
 * This class is used to...
 *
 * @example
 */
class UnixCommand
    extends ProcessorAbstract
{
    public function execute(ProcessorEvent $event = null)
    {
        // change to chdir
        $dir = $this->getParameter("chdir");
        if ($dir) {
            chdir($dir);
        }

        // change params
        $command = $this->getParameter("command");
        preg_match_all('/{{([a-zA-Z0-9\.\-\_]+)}}/', $command, $matches);
        $parameterList = $matches[1];
        foreach ($parameterList as $parameterKey) {
            $val = $this->getParameter($parameterKey);
            if ($val) {
                $command = str_replace('{{'.$parameterKey.'}}', escapeshellarg($val), $command);
            } else {
                $command = str_replace('{{'.$parameterKey.'}}', '', $command);
            }
        }

        $process = new Process($command);
        $process->setTimeout(3600);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        return $process->getOutput();
    }
}
