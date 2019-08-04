<?php

use ChipBeekeeper\Application\PlayBeekeeperCommand;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

return [
    'application' =>
        function (ContainerInterface $container) {
            $consoleApplication = new Application();
            $consoleApplication->addCommands($container->get('commands'));
            return $consoleApplication;
        },
    'commands' =>
        function (ContainerInterface $container) {
            return [new PlayBeekeeperCommand()];
        },
    ];
