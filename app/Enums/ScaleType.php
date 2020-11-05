<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ScaleLevelOne()
 * @method static static ScaleLevelTwo()
 * @method static static ScaleLevelThree()
 * @method static static ScaleLevelFour()
 * @method static static ScaleLevelFive()
 * @method static static ScaleLevelSix()
 */
final class ScaleType extends Enum
{
    const ScaleLevelOne   = "1-10";
    const ScaleLevelTwo   = "10-50";
    const ScaleLevelThree = "50-100";
    const ScaleLevelFour  = "100-500";
    const ScaleLevelFive  = "500-1000";
    const ScaleLevelSix   = "> 1000";
}
