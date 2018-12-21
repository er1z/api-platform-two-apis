<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 20.12.2018
 * Time: 21:56
 */

namespace App\ApiPlatform;


use ApiPlatform\Core\Metadata\Resource\Factory\ResourceNameCollectionFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceNameCollection;
use Symfony\Component\HttpFoundation\RequestStack;

class ResourceNameCollectionFactoryDecorator implements ResourceNameCollectionFactoryInterface
{
    /**
     * @var ResourceNameCollectionFactoryInterface
     */
    private $decorated;
    /**
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var ContextDiscriminator
     */
    private $contextDiscriminator;

    public function __construct(
        ResourceNameCollectionFactoryInterface $decorated,
        RequestStack $requestStack,
        ContextDiscriminator $contextDiscriminator
    )
    {
        $this->decorated = $decorated;
        $this->requestStack = $requestStack;
        $this->contextDiscriminator = $contextDiscriminator;
    }


    /**
     * Creates the resource name collection.
     */
    public function create(): ResourceNameCollection
    {
        $result = $this->decorated->create();
        $classes = iterator_to_array($result->getIterator());

        $classes = array_filter($classes, function($arg){
            return (
                strpos($arg, 'App\DTO\External')===0 && !$this->contextDiscriminator->isInternal()
            ) || (
                strpos($arg, 'App\DTO\Internal')===0 && $this->contextDiscriminator->isInternal()
            );
        });

        return new ResourceNameCollection($classes);
    }
}