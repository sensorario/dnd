<?php

namespace Sensorario\DnD;

class FightContext
{
    private $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function startTurn()
    {
        $this->params['attackerIndex'] = $this->params['turns'] % 2;
        $this->params['difensorIndex'] = ($this->params['turns'] + 1) % 2;
    }

    public function getAttackerBab()
    {
        return $this->params['opponents'][$this->params['attackerIndex']]['bab'];
    }

    public function getDifensorCa()
    {
        return $this->params['opponents'][$this->params['difensorIndex']]['ca'];
    }

    public function getDifensorPf()
    {
        return $this->params['opponents'][$this->params['difensorIndex']]['pf'];
    }

    public function applyDamage($damage)
    {
        $this->params['opponents'][$this->params['difensorIndex']]['pf'] -= $damage;
    }

    public function getAttackerName()
    {
        return $this->params['opponents'][$this->params['attackerIndex']]['name'];
    }

    public function getDifensorName()
    {
        return $this->params['opponents'][$this->params['difensorIndex']]['name'];
    }

    public function isDifensorDied()
    {
        return $this->params['opponents'][$this->params['difensorIndex']]['pf'] <= 0;
    }

    public function turnFinished()
    {
        $this->params['turns']++;
    }

    public function getSfidanti()
    {
        return $this->params['opponents'];
    }

    public function getNumberOfTurns()
    {
        return $this->params['turns'];
    }
}
