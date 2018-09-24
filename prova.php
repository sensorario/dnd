<?php

include_once __DIR__ . '/vendor/autoload.php';

use Sensorario\Develog\Logger\NormaLogger;
use Sensorario\DnD\Actions\Fight;
use Sensorario\DnD\Dice\Dice;
use Sensorario\DnD\FightContext;

$logger = new NormaLogger();
$logger->setSizeLimitInBytes(2000000);
$logger->setLogFile('logs/debug.log');

$fight = new Fight(
    new Dice(),
    new FightContext([
        'opponents' => [
            [
                'name' => 'Rupert',
                'pf'   => 42,
                'ca'   => 10,
                'bab'  => 3,
            ],
            [
                'name' => 'Norbert',
                'pf'   => 42,
                'ca'   => 10,
                'bab'  => 3,
            ],
        ],
        'turns' => 0,
    ]),
    $logger
);

$fight->run();

echo $fight->getWinner();
