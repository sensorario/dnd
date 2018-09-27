<?php

namespace Sensorario\DnD\Dice;

class Dice
{
    public function d20()
    {
        return rand(1, 20);
    }

    public function d10()
    {
        return rand(1, 10);
    }
}
