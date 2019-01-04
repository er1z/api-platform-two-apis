<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 20.12.2018
 * Time: 22:04
 */

namespace Er1z\MultiApiPlatform\DependencyInjection\CompilerPass;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ApiLoaderArgumentAdjusterPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     */
    public function process(ContainerBuilder $container)
    {
        // during route cache warm-up we need all routes to be collected
        $def = $container->findDefinition('api_platform.route_loader');
        $def->setArgument(1, new Reference(
            'Er1z\MultiApiPlatform\ApiPlatform\ResourceNameCollectionFactoryDecorator.inner'
        ));
    }
}