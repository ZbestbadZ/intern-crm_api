<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ScaleType extends Enum
{
    const LevelOne   = "1-10";
    const LevelTwo   = "10-50";
    const LevelThree = "50-100";
    const LevelFour  = "100-500";
    const LevelFive  = "500-1000";
    const LevelSix   = "1000 ~";
}
