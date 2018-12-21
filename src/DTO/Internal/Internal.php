<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 20.12.2018
 * Time: 21:44
 */

namespace App\DTO\Internal;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Er1z\FakeMock\Annotations\FakeMock;
use Er1z\FakeMock\Annotations\FakeMockField;

/**
 * Class First
 * @package App\DTO\Internal
 * @ApiResource()
 * @FakeMock()
 */
class Internal
{

    /**
     * @var int
     * @ApiProperty(identifier=true)
     * @FakeMockField()
     */
    public $id;

    /**
     * @var string
     * @FakeMockField()
     */
    public $internalString;

}