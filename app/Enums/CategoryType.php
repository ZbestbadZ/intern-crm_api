<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CategoryType extends Enum
{
    const CategoryLevelOne   = 1;
    const CategoryLevelTwo   = 2;
    const CategoryLevelThree = 3;
    const CategoryLevelFour  = 4;
    const CategoryLevelFive  = 5;
    const CategoryLevelOfficial   = 6;
}
