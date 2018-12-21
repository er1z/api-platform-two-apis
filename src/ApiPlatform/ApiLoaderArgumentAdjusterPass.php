<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 20.12.2018
 * Time: 22:04
 */

namespace App\ApiPlatform;


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
        $def = $container->findDefinition('api_platform.route_loader');
        $def->setArgument(1, new Reference(
            'App\ApiPlatform\ResourceNameCollectionFactoryDecorator.inner'
        ));
    }
}