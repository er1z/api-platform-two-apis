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

class ResourceNameCollectionFactoryDecorator implements ResourceNameCollectionFactoryInterface
{
    /**
     * @var ResourceNameCollectionFactoryInterface
     */
    private $decorated;

    public function __construct(ResourceNameCollectionFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }


    /**
     * Creates the resource name collection.
     */
    public function create(): ResourceNameCollection
    {
        $result = $this->decorated->create();
        $classes = iterator_to_array($result->getIterator());

        $classes = array_filter($classes, function($arg){
            return strpos($arg, 'App\DTO\External')===0;
        });

        return new ResourceNameCollection($classes);
    }
}