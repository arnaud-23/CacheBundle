<?php

namespace OpenClassrooms\Bundle\CacheBundle;

use OpenClassrooms\Bundle\CacheBundle\DependencyInjection\Compiler\AddDefaultLifetimePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Romain Kuzniak <romain.kuzniak@openclassrooms.com>
 */
class OpenClassroomsCacheBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddDefaultLifetimePass());
    }

}
