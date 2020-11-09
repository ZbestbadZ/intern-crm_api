<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class FondsType extends Enum
{
    const LevelOne =   1;  //1-1000万円
    const LevelTwo =   2; // 1000-5000万円
    const LevelThree = 3; // "5000~1億円"
    const LevelFour = 4; // 1億円 ~
}
