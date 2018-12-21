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

/**
 * Class First
 * @package App\DTO\Internal
 * @ApiResource()
 */
class Second
{

    /**
     * @var int
     * @ApiProperty(identifier=true)
     */
    public $id;

    /**
     * @var string
     */
    public $firstString;

}