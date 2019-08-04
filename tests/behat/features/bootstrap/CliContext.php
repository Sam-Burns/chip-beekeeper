<?php
namespace BehatContexts;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;

class CliContext implements Context
{
    /** @var string[] */
    private $result;

    /**
     * @When I run the game and type hit repeatedly
     */
    public function iRunTheGameAndTypeHitRepeatedly()
    {
        exec('yes hit | php bin/beekeeper.php play 2>/dev/null', $this->result);
    }

    /**
     * @Then I should be informed of how many hits were needed to destroy the hive
     */
    public function iShouldBeInformedOfHowManyHitsWereNeededToDestroyTheHive()
    {
        Assert::assertRegExp('/^It took \d+ hits to kill all the bees$/', end($this->result));
    }

    /**
     * @Then that number should be less than :maxHits hits
     */
    public function thatNumberShouldBeLessThanHits(int $maxHits)
    {
        $matches = [];
        preg_match('/^It took (\d+) hits to kill all the bees$/', end($this->result), $matches);

        $totalHits = $matches[1];

        Assert::lessThan($maxHits, $totalHits);
    }
}
