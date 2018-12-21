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
use App\DTO\External\First;
use App\DTO\Internal\Second;

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
        for($a=0;$a<3;$a++){

        }
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass==First::class || $resourceClass==Second::class;
    }
}