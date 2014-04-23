<?php

namespace OpenClassrooms\Bundle\CacheBundle\Tests\DependencyInjection;

use OpenClassrooms\Bundle\CacheBundle\DependencyInjection\OpenClassroomsCacheExtension;
use OpenClassrooms\Bundle\CacheBundle\OpenClassroomsCacheBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author Romain Kuzniak <romain.kuzniak@openclassrooms.com>
 */
class YamlOpenClassroomsCacheExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Extension
     */
    private $extension;

    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var Loader
     */
    private $loader;

    /**
     * @test
     */
    public function NoConfiguration_ContainerHasArrayCache()
    {
        $this->container->compile();

        $cacheProvider = $this->container->get('openclassrooms.cache.cache_provider');
        $cache = $this->container->get('openclassrooms.cache.cache');

        $this->assertInstanceOf('Doctrine\Common\Cache\ArrayCache', $cacheProvider);
        $this->assertAttributeInstanceOf('Doctrine\Common\Cache\ArrayCache', 'cache', $cache);
        $this->assertAttributeEquals(0, 'defaultLifetime', $cache);
    }

    /**
     * @test
     */
    public function DefaultLifetime_CacheHasDefaultLifeTime()
    {
        $this->loader->load('DefaultLifetimeConfig.yml');
        $this->container->compile();

        $cache = $this->container->get('openclassrooms.cache.cache');

        $this->assertAttributeEquals(10, 'defaultLifetime', $cache);
    }

    /**
     * @test
     */
    public function RedisConfiguration_ContainerHasArrayCache()
    {
        $this->loader->load('RedisConfig.yml');
        $this->container->compile();

        $cacheProvider = $this->container->get('openclassrooms.cache.cache_provider');
        $cache = $this->container->get('openclassrooms.cache.cache');

        $this->assertInstanceOf('Doctrine\Common\Cache\ArrayCache', $cacheProvider);
        $this->assertAttributeInstanceOf('Doctrine\Common\Cache\ArrayCache', 'cache', $cache);
    }

    /**
     * @test
     */
    public function MemcacheConfiguration_ContainerHasMemcacheCache()
    {
        $cache = $this->container->get('openclassrooms.cache.cache');
        $this->assertAttributeInstanceOf('Doctrine\Common\Cache\MemcacheCache', 'cache', $cache);
    }

    protected function setUp()
    {
        $this->extension = new OpenClassroomsCacheExtension();
        $this->container = new ContainerBuilder();
        $this->container->registerExtension($this->extension);
        $this->container->loadFromExtension('openclassrooms_cache');

        $bundle = new OpenClassroomsCacheBundle();
        $bundle->build($this->container);

        $this->loader = new YamlFileLoader($this->container, new FileLocator(__DIR__ . '/Fixtures/Yaml/'));
    }
}
