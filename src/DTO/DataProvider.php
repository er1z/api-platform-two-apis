<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 20.12.2018
 * Time: 22:14
 */

namespace App\DTO;


use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\DTO\External\External;
use App\DTO\Internal\Internal;
use Er1z\FakeMock\FakeMock;

class DataProvider implements RestrictedDataProviderInterface, CollectionDataProviderInterface
{

    /**
     * Retrieves a collection.
     *
     * @throws ResourceClassNotSupportedException
     *
     * @return array|\Traversable
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        $fakemock = new FakeMock();
        for($a=0;$a<3;$a++){
            yield $fakemock->fill($resourceClass);
        }
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass==External::class || $resourceClass==Internal::class;
    }
}