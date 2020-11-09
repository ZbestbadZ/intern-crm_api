<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ScaleType extends Enum
{
    const LevelOne   = 1;  //1-10
    const LevelTwo   = 2; //10-50
    const LevelThree = 3; //50-100
    const LevelFour  = 4; //100-500
    const LevelFive  = 5; //500-1000
    const LevelSix   = 6; //1000~
}
