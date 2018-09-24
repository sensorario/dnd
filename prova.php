<?php

include_once __DIR__ . '/vendor/autoload.php';

use Sensorario\DnD\Actions\Fight;
use Sensorario\DnD\Dice\Dice;
use Sensorario\Develog\Logger\NormaLogger;

$logger = new NormaLogger();
$logger->setSizeLimitInBytes(2000000);
$logger->setLogFile('logs/debug.log');

$fight = new Fight(
    new Dice(),
    $logger
);

$fight->run();
