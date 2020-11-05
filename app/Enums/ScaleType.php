<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ScaleType extends Enum
{
    const ScaleLevelOne   = "1-10";
    const ScaleLevelTwo   = "10-50";
    const ScaleLevelThree = "50-100";
    const ScaleLevelFour  = "100-500";
    const ScaleLevelFive  = "500-1000";
    const ScaleLevelSix   = "> 1000";
}
