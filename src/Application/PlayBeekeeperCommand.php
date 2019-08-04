<?php
namespace ChipBeekeeper\Application;

use ChipBeekeeper\Domain\Hive;
use Symfony\Component\Console\Command\Command as SymfonyConsoleCommand;
use Symfony\Component\Console\Helper\QuestionHelper;
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

        $questionHelper = $this->getHelper('question');
        $question = new Question("Take your turn by typing 'hit': [hit] ", 'hit');

        $totalHits = 0;

        while (!$this->hive->allBeesAreDead()) {
            $this->acceptUsersTurn($questionHelper, $input, $output, $question);
            $this->hive->hitRandomBee();
            $this->reportOnHivePopulation($output);
            ++$totalHits;
        }

        $output->writeln("It took $totalHits hits to kill all the bees");
    }

    private function acceptUsersTurn(QuestionHelper $questionHelper, InputInterface $input, OutputInterface $output, Question $question)
    {
        $inputWord = $questionHelper->ask($input, $output, $question);
        if ($inputWord !== 'hit') {
            throw new PebkacException();
        }
    }

    private function reportOnHivePopulation(OutputInterface $output)
    {
        $output->writeln(sprintf(
            'There are now %d queen bees, %d worker bees and %d drone bees left alive',
            $this->hive->noOfQueenBees(),
            $this->hive->noOfWorkerBees(),
            $this->hive->noOfDroneBees()
        ));
    }
}
