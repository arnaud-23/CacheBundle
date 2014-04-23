<?php

namespace OpenClassrooms\Bundle\CacheBundle\DependencyInjection\Compiler;

use OpenClassrooms\Cache\CacheProvider\CacheProviderBuilderImpl;
use OpenClassrooms\Cache\CacheProvider\CacheProviderType;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author Romain Kuzniak <romain.kuzniak@openclassrooms.com>
 */
class AddCacheProviderPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $cacheProviderBuilder = new CacheProviderBuilderImpl();

        switch ($container->getParameter('openclassrooms.cache.cache_provider_type')) {
            case CacheProviderType::MEMCACHE:
                $cacheProvider = $cacheProviderBuilder
                    ->create(CacheProviderType::MEMCACHE)
                    ->withHost('openclassrooms.cache.server_host')
                    ->withPort('openclassrooms.cache.server_port')
                    ->withTimeout('openclassrooms.cache.server_timeout')
                    ->build();
                break;
            case CacheProviderType::MEMCACHED:
                $cacheProvider = $cacheProviderBuilder
                    ->create(CacheProviderType::MEMCACHED)
                    ->withHost('openclassrooms.cache.server_host')
                    ->withPort('openclassrooms.cache.server_port')
                    ->build();
                break;
            case CacheProviderType::REDIS:
                $cacheProvider = $cacheProviderBuilder
                    ->create(CacheProviderType::REDIS)
                    ->withHost('openclassrooms.cache.server_host')
                    ->withPort('openclassrooms.cache.server_port')
                    ->withTimeout('openclassrooms.cache.server_timeout')
                    ->build();
                break;
            case CacheProviderType::ARRAY_CACHE:
            default:
                $cacheProvider = $cacheProviderBuilder
                    ->create(CacheProviderType::ARRAY_CACHE)
                    ->build();
        }

        $container->set('openclassrooms.cache.cache_provider', $cacheProvider);
    }

}