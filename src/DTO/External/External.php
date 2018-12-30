<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 20.12.2018
 * Time: 21:48
 */

namespace App\DTO\External;


use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Er1z\FakeMock\Annotations\FakeMock;
use Er1z\FakeMock\Annotations\FakeMockField;

/**
 * Class Struct
 * @package App\DTO\External
 * @ApiResource()
 * @FakeMock()
 */
class External
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
    public $externalString;

}