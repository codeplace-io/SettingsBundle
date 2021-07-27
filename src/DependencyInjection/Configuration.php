<?php
declare(strict_types=1);

namespace Codeplace\SettingsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('codeplace_settings');
        $rootNode = \method_exists(TreeBuilder::class, 'getRootNode') ?
            $treeBuilder->getRootNode() : $treeBuilder->root('codeplace_settings');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('settings_class')
                    ->isRequired()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}