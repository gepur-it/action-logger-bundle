<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 10.11.17
 */

namespace Tests;

use GepurIt\ActionLoggerBundle\DependencyInjection\Compiler\ActionLoggerCompilerPass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ActionLoggerCompilerPassTest
 * @package ActionLoggerBundle\DependencyInjection\Compiler
 */
class ActionLoggerCompilerPassTest extends TestCase
{
    public function testServiceNotFound()
    {
        $container = $this->getContainerMock();
        $container->expects($this->once())
            ->method('hasDefinition')
            ->with(ActionLoggerCompilerPass::SERVICE_NAME)
            ->willReturn(false);

        $container->expects($this->never())
            ->method('hasAlias');

        $compilerPass = new ActionLoggerCompilerPass();
        $compilerPass->process($container);
    }

    public function testCompilerPassHasNoAlias()
    {
        $container = $this->getContainerMock();
        $container->expects($this->once())
            ->method('hasDefinition')
            ->with(ActionLoggerCompilerPass::SERVICE_NAME)
            ->willReturn(true);
        $container->expects($this->once())
            ->method('hasAlias')
            ->with(ActionLoggerCompilerPass::SERVICE_ALIAS)
            ->willReturn(false);
        $container->expects($this->never())
            ->method('removeAlias');
        $container->expects($this->once())
            ->method('addAliases');

        $compilerPass = new ActionLoggerCompilerPass();
        $compilerPass->process($container);
    }

    public function testCompilerPassHasAlias()
    {
        $container = $this->getContainerMock();
        $container->expects($this->once())
            ->method('hasDefinition')
            ->with(ActionLoggerCompilerPass::SERVICE_NAME)
            ->willReturn(true);
        $container->expects($this->once())
            ->method('hasAlias')
            ->with(ActionLoggerCompilerPass::SERVICE_ALIAS)
            ->willReturn(true);
        $container->expects($this->once())
            ->method('removeAlias')
            ->with(ActionLoggerCompilerPass::SERVICE_ALIAS);
        $container->expects($this->once())
            ->method('addAliases');

        $compilerPass = new ActionLoggerCompilerPass();
        $compilerPass->process($container);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ContainerBuilder
     */
    private function getContainerMock()
    {
        $mock = $this->getMockBuilder(ContainerBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(
                [
                    'hasDefinition',
                    'hasAlias',
                    'removeAlias',
                    'addAliases',
                ]
            )
            ->getMock();

        return $mock;
    }
}

