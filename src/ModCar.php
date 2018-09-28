<?php

namespace Sensorario\DnD;

class ModCar
{
    private $ability;

    private $proficiency;

    public function __construct(
        Ability $ability,
        Proficiency $proficiency
    ) {
        $this->ability = $ability;
        $this->proficiency = $proficiency;
    }

    public function elaborate()
    {
        return $this->ability->use()
            + $this->proficiency->use();
    }
}
