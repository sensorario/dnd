<?php

namespace Sensorario\DnD;

use Psr\Log\LoggerInterface;

class FightContext
{
    private $params;

    private $logger;

    private $editor;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
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
        $this->logger->debug(
            $this->getAttackerName() .
            " infligge un danno di " . $damage
            . " a " . $this->getDifensorName()
            . " che aveva " . $this->getDifensorPf()
        );

        $this->params['opponents'][$this->params['difensorIndex']]['pf'] -= $damage;
    }

    public function getAttackerName()
    {
        return $this->params['opponents'][$this->params['attackerIndex']]['name'];
    }

    public function getAttackerSize()
    {
        $size = $this->params['opponents'][$this->params['attackerIndex']]['size'];

        return Dictionary::sizeModifier($size);
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
