<?php

namespace OpenClassrooms\Bundle\CacheBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Romain Kuzniak <romain.kuzniak@openclassrooms.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('openclassrooms_cache');
        $rootNode
            ->children()
                ->scalarNode('default_lifetime')
                    ->defaultValue(0)
                ->end()
            ->end()
            ->children()
                ->arrayNode('provider')
//                    ->beforeNormalization()
//                    ->ifString()
//                        ->then(function($v) { return array('type'=> $v); })
//                    ->end()
//
//                    ->useAttributeAsKey('type')
//                    ->children()
//                    ->prototype('array')
                        ->children()
                            ->append($this->addRedisNode())
//                            ->arrayNode('type')
//                            ->beforeNormalization()
//                                ->ifString()
//                                    ->then(function($v) { return array('type'=> $v); })
//                                ->end()
//                            ->end()
//                            ->scalarNode('host')->defaultValue('value')->end()
//                            ->scalarNode('port')->end()
//                            ->end()
//                        ->end()
                    ->end()
//                ->end()
            ->end()
//                ->treatNullLike(array('type'=>'array'))
//                    ->beforeNormalization()
//                    ->ifString()
//                        ->then(function($v) { return array('type' => $v); })
//                    ->end()
//                ->prototype('scalar')->end()
//                ->defaultValue(array('type' => 'array'))->end()
//                    ->children()
//                        ->scalarNode('test')->defaultValue(0)->end()
//                    ->end()
//                ->end()
//            ->end()
        ->end();

//                        ->append($this->addMemcacheNode())

//                        ->append($this->addRedisNode())
//                    ->end()
//                ->end()
//            ->end();
        return $treeBuilder;
    }

    /**
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    private function addMemcacheNode()
    {
        $nodeBuilder = new TreeBuilder();
        $node = $nodeBuilder->root('memcache');

        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('host')->end()
                ->scalarNode('port')->defaultValue(11211)->end()
                ->scalarNode('timeout')->defaultValue(0)->end()
            ->end();

        return $node;
    }

    /**
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    private function addMemcachedNode()
    {
        $nodeBuilder = new TreeBuilder();
        $node = $nodeBuilder->root('memcached');

        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('host')->end()
                ->scalarNode('port')->defaultValue(1121)->end()
            ->end();

        return $node;
    }

    /**
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder
     */
    private function addRedisNode()
    {
        $nodeBuilder = new TreeBuilder();
        $node = $nodeBuilder->root('redis');

        $node
            ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('connection_id')->defaultNull()->end()
                    ->scalarNode('host')->end()
                    ->scalarNode('port')->defaultValue(6379)->end()
                    ->scalarNode('timeout')->defaultValue(0.0)->end()
                ->end();

        return $node;
    }
}
