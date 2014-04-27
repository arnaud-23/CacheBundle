<?php

namespace OpenClassrooms\Bundle\CacheBundle\Tests\Cache;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Cache\MemcacheCache;
use Doctrine\Common\Cache\MemcachedCache;
use Doctrine\Common\Cache\RedisCache;
use OpenClassrooms\Bundle\CacheBundle\Tests\Cache\CacheServer\MemcachedSpy;
use OpenClassrooms\Bundle\CacheBundle\Tests\Cache\CacheServer\MemcacheSpy;
use OpenClassrooms\Bundle\CacheBundle\Tests\Cache\CacheServer\RedisSpy;
use OpenClassrooms\Cache\CacheProvider\CacheProviderBuilder;
use OpenClassrooms\Cache\CacheProvider\CacheProviderBuilderImpl;
use OpenClassrooms\Cache\CacheProvider\CacheProviderType;
use OpenClassrooms\Cache\CacheProvider\Exception\InvalidCacheProviderTypeException;

/**
 * @author Romain Kuzniak <romain.kuzniak@openclassrooms.com>
 */
class CacheProviderBuilderMock extends CacheProviderBuilderImpl
{
    /**
     * @return CacheProviderBuilder
     */
    public function create($cacheProviderType)
    {
        $this->cacheProviderType = $cacheProviderType;
        switch ($this->cacheProviderType) {
            case CacheProviderType::MEMCACHE:
                $this->cacheProvider = new MemcacheCache();
                $this->server = new MemcacheSpy();
                break;
            case CacheProviderType::MEMCACHED:
                $this->cacheProvider = new MemcachedCache();
                $this->server = new MemcachedSpy();
                break;
            case CacheProviderType::REDIS:
                $this->cacheProvider = new RedisCache();
                $this->server = new RedisSpy();
                break;
            case CacheProviderType::ARRAY_CACHE:
                $this->cacheProvider = new ArrayCache();
                break;
            default:
                throw new InvalidCacheProviderTypeException();
        }

        return $this;
    }
}
