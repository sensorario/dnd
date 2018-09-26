<?php

namespace Sensorario\DnD;

class Semafore
{
    private $finished;

    public function turnOn()
    {
        $this->finished = false;
    }

    public function isGreen()
    {
        return !$this->finished;
    }

    public function stop()
    {
        $this->finished = true;
    }
}
