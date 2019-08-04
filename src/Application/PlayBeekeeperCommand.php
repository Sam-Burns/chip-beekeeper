<?php
namespace ChipBeekeeper\Application;

use Symfony\Component\Console\Command\Command as SymfonyConsoleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PlayBeekeeperCommand extends SymfonyConsoleCommand
{
    public function configure()
    {
        $this->setName('play');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello world');
    }
}
