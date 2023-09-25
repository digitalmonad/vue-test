<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

header('Access-Control-Allow-Headers: accept, content-type, authorization');
header('Access-Control-Allow-Methods: GET,POST,OPTIONS,DELETE,PUT');
header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") { return; }

$configurator = App\Bootstrap::boot();
$container = $configurator->createContainer();
$application = $container->getByType(Nette\Application\Application::class);
$application->run();
