<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 27.09.17
 */

namespace GepurIt\ActionLoggerBundle;

use GepurIt\ActionLoggerBundle\DependencyInjection\Compiler\ActionLoggerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ActionLoggerBundle
 */
class ActionLoggerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ActionLoggerCompilerPass());
    }
}

