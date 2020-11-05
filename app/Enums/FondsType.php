<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static FondsLevelOne()
 * @method static static FondsLevelTwo()
 * @method static static FondsLevelThree()
 * @method static static FondsLevelFour()
 */
final class FondsType extends Enum
{
    const FondsLevelOne =   "1- 1000万円";
    const FondsLevelTwo =   "1000-5000万円";
    const FondsLevelThree = "5000~1億円";
    const FondsLevelFour = "1億円 ~";
}
