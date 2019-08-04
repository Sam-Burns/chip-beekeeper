<?php
namespace ChipBeekeeper\Application;

use ChipBeekeeper\Domain\Hive;
use Symfony\Component\Console\Command\Command as SymfonyConsoleCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class PlayBeekeeperCommand extends SymfonyConsoleCommand
{
    /** @var Hive */
    private $hive;

    public function __construct(Hive $hive)
    {
        parent::__construct();
        $this->hive = $hive;
    }

    public function configure()
    {
        $this->setName('play');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Welcome to Beekeeper');

        $totalHits = 0;

        while (!$this->hive->allBeesAreDead()) {
            $this->acceptUsersTurn($input, $output);
            $this->hive->hitRandomBee();
            $this->reportOnTurn($this->hive, $output);
            ++$totalHits;
        }

        $output->writeln("It took $totalHits hits to kill all the bees");
    }

    private function acceptUsersTurn(InputInterface $input, OutputInterface $output)
    {
        $questionHelper = $this->getHelper('question');
        $question = new Question("Take your turn by typing 'hit': [hit] ", 'hit');
        $inputWord = $questionHelper->ask($input, $output, $question);
        if ($inputWord !== 'hit') {
            throw new PebkacException();
        }
    }

    private function reportOnTurn(Hive $hive, OutputInterface $output)
    {
        $reportingDetails = $hive->getReportingDetails();
        $output->writeln(sprintf(
            "You hit a %s. It now has %d points left. %d Queen Bees, %d Worker Bees and %d Drone Bees remain.",
            $reportingDetails['bee-name'],
            $reportingDetails['remaining-hit-points'],
            $reportingDetails['no-of-queen-bees'],
            $reportingDetails['no-of-worker-bees'],
            $reportingDetails['no-of-drone-bees'],
        ));
    }
}
