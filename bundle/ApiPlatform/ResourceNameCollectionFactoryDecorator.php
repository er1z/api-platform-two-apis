<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 20.12.2018
 * Time: 21:56
 */

namespace Er1z\MultiApiPlatform\ApiPlatform;


use ApiPlatform\Core\Metadata\Resource\Factory\ResourceNameCollectionFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceNameCollection;
use Er1z\MultiApiPlatform\ExecutionContext;

class ResourceNameCollectionFactoryDecorator implements ResourceNameCollectionFactoryInterface
{
    /**
     * @var ResourceNameCollectionFactoryInterface
     */
    private $decorated;
    /**
     * @var ExecutionContext
     */
    private $executionContext;

    public function __construct(
        ResourceNameCollectionFactoryInterface $decorated,
        ExecutionContext $executionContext
    )
    {
        $this->decorated = $decorated;
        $this->executionContext = $executionContext;
    }


    /**
     * Creates the resource name collection.
     */
    public function create(): ResourceNameCollection
    {
        $result = $this->decorated->create();
        $classes = iterator_to_array($result->getIterator());

        $classes = array_filter($classes, [$this->executionContext, 'isClassAvailable']);

        return new ResourceNameCollection($classes);
    }
}