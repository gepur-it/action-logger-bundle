<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 27.09.17
 */

namespace GepurIt\ActionLoggerBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ActionLoggerCompilerPass
 * @package DependencyInjection\Compiler
 */
class ActionLoggerCompilerPass implements CompilerPassInterface
{
    const SERVICE_NAME = 'database_action_logger';
    const SERVICE_ALIAS = 'app.action_logger';
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('database_action_logger')) {
            return;
        }
        if ($container->hasAlias('app.action_logger')) {
            $container->removeAlias('app.action_logger');
        }
        $alias = new Alias('database_action_logger', true);
        $container->addAliases(['app.action_logger' => $alias]);
    }
}

