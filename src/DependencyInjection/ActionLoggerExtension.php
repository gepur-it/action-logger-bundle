<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 27.09.17
 */

namespace  GepurIt\ActionLoggerBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class ActionLoggerExtension
 * @package DependencyInjection
 * @codeCoverageIgnore
 */
class ActionLoggerExtension extends Extension
{

    /**
     * Loads a specific configuration.
     *
     * @param array $configs An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        {
            $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
            $loader->load('config.yml');

            $configuration = $this->getConfiguration($configs, $container);
            $config = $this->processConfiguration($configuration, $configs);

            if ($config) {
                foreach ($config as $name => $value) {
                    $container->setParameter($name, $value);
                }
            }
        }
    }

    public function getAlias()
    {
        return 'action_logger';
    }
}
