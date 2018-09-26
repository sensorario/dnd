<?php

namespace Sensorario\DnD;

class Dictionary
{
    private static $sizes = [
        'Colossal' => -8,
        'Gargantuan' => -4,
        'Huge' => -2,
        'Large' => -1,
        'Medium' => +0,
        'Small' => +1,
        'Tiny' => +2,
        'Diminutive' => +4,
        'Fine' => +8,
    ];

    public static function sizeModifier($size)
    {
        return self::$sizes[$size];
    }
}
