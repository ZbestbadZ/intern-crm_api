<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CapitalType extends Enum
{
    const LevelOne =   "1- 1000万円";
    const LevelTwo =   "1000-5000万円";
    const LevelThree = "5000~1億円";
    const LevelFour = "1億円 ~";
}
