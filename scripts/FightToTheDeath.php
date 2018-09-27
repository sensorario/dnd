<?php

include_once __DIR__ . '/vendor/autoload.php';

use Sensorario\Develog\Logger\NormaLogger;
use Sensorario\DnD\Actions\Fight;
use Sensorario\DnD\Dice\Dice;
use Sensorario\DnD\FightContext;
use Sensorario\DnD\Semafore;

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
                'size' => 'Medium',
            ],
            [
                'name' => 'Norbert',
                'pf'   => 42,
                'ca'   => 10,
                'bab'  => 3,
                'size' => 'Medium',
            ],
        ],
        'turns' => 0,
    ]),
    new Semafore(),
    $logger
);

$fight->run();

echo $fight->getWinner();
