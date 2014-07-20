<?php

namespace OpenClassrooms\Bundle\CacheBundle\Services;

use Doctrine\Common\Cache\CacheProvider;

/**
 * @author Romain Kuzniak <romain.kuzniak@openclassrooms.com>
 */
interface CacheProviderFactory
{
    /**
     * @return CacheProvider
     */
    public function create();
}
