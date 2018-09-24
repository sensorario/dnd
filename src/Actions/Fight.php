<?php

namespace Sensorario\DnD\Actions;

use Psr\Log\LoggerInterface;
use Sensorario\DnD\Dice\Dice;

class Fight
{
    private $finished;

    private $dice;

    private $logger;

    private $winner;

    public function __construct(
        Dice $dice,
        LoggerInterface $logger = null
    ) {
        $this->dice = $dice;
        $this->logger = $logger;
    }

    public function run($p1, $p2)
    {
        $this->opponents = [];
        $this->opponents[] = $p1;
        $this->opponents[] = $p2;
        $this->turns = 0;

        $this->game = [
            'opponents' => $this->opponents,
            'turns' => $this->turns,
        ];

        $this->blackShots = 0;
        $this->finished = false;

        while (!$this->finished) {

            /** @todo detect attacker and defender */
            $this->game['attackerIndex'] = $this->game['turns'] % 2;
            $this->game['difensorIndex'] = ($this->game['turns'] + 1) % 2;

            /** @todo extract bab ca and d20 dice */
            $bab     = $this->game['opponents'][$this->game['attackerIndex']]['bab'];
            $d20     = $this->dice->d20();
            $attacco = $d20 + $bab;

            /** @todo damage calculation */
            $ca          = $this->game['opponents'][$this->game['difensorIndex']]['ca'];
            $ciSonoDanni = $attacco >= $ca;

            if ($ciSonoDanni > 0) {

                $this->blackShots = 0;

                /** @todo $this->damager->calculate() */
                $danni = $this->dice->d10() + 4;
                $currentTurn['danni'] = $danni;

                /** @todo applyDamage */
                $this->game['opponents'][$this->game['difensorIndex']]['pf'] -= $danni;

                $this->logger->debug(
                    $this->game['opponents'][$this->game['attackerIndex']]['name'] .
                    " infligge un danno di " . $danni
                    . " a " . $this->game['opponents'][$this->game['difensorIndex']]['name']
                );

            } else {

                $this->blackShots++;

                $this->logger->debug(
                    $this->opponents[$this->game['attackerIndex']]['name'] .
                    " segna un colpo a vuoto "
                );

            }

            if ($this->game['opponents'][$this->game['difensorIndex']]['pf'] <= 0) {
                $this->winner = $this->game['opponents'][$this->game['difensorIndex']]['name'];
                $this->finished = true;
            }

            if ($this->blackShots > 10) {
                throw new \RuntimeException(
                    'Oops! Too Many blank shot'
                );
            }

            $this->game['turns']++;
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
        return $this->game['opponents'];
    }

    public function getWinner()
    {
        return $this->winner;
    }

    public function numberOfTurns()
    {
        return $this->game['turns'];
    }
}
