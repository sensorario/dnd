<?php

namespace Sensorario\DnD\Actions;

use Psr\Log\LoggerInterface;
use Sensorario\DnD\Dice\Dice;
use Sensorario\DnD\FightContext;

class Fight
{
    private $finished;

    private $winner;

    private $dice;

    private $context;

    private $logger;

    public function __construct(
        Dice $dice,
        FightContext $context,
        LoggerInterface $logger = null
    ) {
        $this->dice = $dice;
        $this->context = $context;
        $this->logger = $logger;
    }

    public function run()
    {
        $this->blackShots = 0;
        $this->finished = false;

        while (!$this->finished) {

            $this->context->startTurn();

            /** @todo extract bab ca and d20 dice */
            $bab     = $this->context->getAttackerBab();
            $d20     = $this->dice->d20();
            $attacco = $d20 + $bab;

            /** @todo damage calculation */
            $ca          = $this->context->getDifensorCa();
            $ciSonoDanni = $attacco >= $ca;

            if ($ciSonoDanni > 0) {

                $this->blackShots = 0;

                /** @todo $this->damager->calculate() */
                $danni = $this->dice->d10() + 4;
                $currentTurn['danni'] = $danni;

                $this->logger->debug(
                    $this->context->getAttackerName() .
                    " infligge un danno di " . $danni
                    . " a " . $this->context->getDifensorName()
                    . " che aveva " . $this->context->getDifensorPf()
                );

                $this->context->applyDamage($danni);

            } else {

                $this->blackShots++;

                $this->logger->debug(
                    $this->context->getAttackerName() .
                    " segna un colpo a vuoto "
                );

            }

            if ($this->context->isDifensorDied()) {
                $this->winner = $this->context->getAttackerName();
                $this->finished = true;
            }

            if ($this->blackShots > 10) {
                throw new \RuntimeException(
                    'Oops! Too Many blank shot'
                );
            }

            $this->context->turnFinished();
        }

    }

    public function isFinished()
    {
        return $this->finished;
    }

    public function numberOfBlackShot()
    {
        return $this->blackShots;
    }

    public function getSfidanti()
    {
        return $this->context->getSfidanti();
    }

    public function getWinner()
    {
        return $this->winner;
    }

    public function numberOfTurns()
    {
        return $this->context->getNumberOfTurns();
    }
}
