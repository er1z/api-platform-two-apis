<?php


namespace Er1z\MultiApiPlatform\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    const CONFIGURATION_ROOT_KEY = 'multi_api_platform';

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        if (method_exists(TreeBuilder::class, 'getRootNode')) {
            $treeBuilder = new TreeBuilder(self::CONFIGURATION_ROOT_KEY);
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $treeBuilder = new TreeBuilder();
            $rootNode = $treeBuilder->root(self::CONFIGURATION_ROOT_KEY);
        }

        $rootNode
            ->children()
                ->arrayNode('apis')
                ->useAttributeAsKey('api')
                    ->arrayPrototype()
                    ->children()
                        ->scalarNode('namespace')->end()
                        ->scalarNode('implements')->end()
                        ->scalarNode('conditions')->end()
                        ->scalarNode('debug_conditions')->end()
                    ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}