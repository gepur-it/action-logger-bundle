<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 10.11.17
 */

namespace Tests;

use GepurIt\ActionLoggerBundle\ActionLoggerBundle;
use GepurIt\ActionLoggerBundle\DependencyInjection\Compiler\ActionLoggerCompilerPass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ActionLoggerBundleTest extends TestCase
{
    public function testBundle()
    {
        $containerBuilder = $this->getContainerMock();
        $containerBuilder->expects($this->once())
            ->method('addCompilerPass')
            ->with($this->isInstanceOf(ActionLoggerCompilerPass::class));

        $bundle = new ActionLoggerBundle();
        $bundle->build($containerBuilder);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ContainerBuilder
     */
    private function getContainerMock()
    {
        $mock =  $this->getMockBuilder(ContainerBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'addCompilerPass',
            ])
            ->getMock();

        return $mock;
    }
}
