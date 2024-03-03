<?php

use RacingGame\CLI;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/vendor/autoload.php';

$application = new Application();
// Register the command
$application->add((new CLI())->setName('start:race'));
// Run the CLI command to start the race
$application->run();