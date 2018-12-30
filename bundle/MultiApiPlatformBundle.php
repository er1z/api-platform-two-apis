<?php


namespace Er1z\MultiApiPlatform;


use Er1z\MultiApiPlatform\DependencyInjection\CompilerPass\CoverStockSwaggerCommandPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MultiApiPlatformBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new CoverStockSwaggerCommandPass());
    }


}