<?php
/**
 * @copyright 2019 Alaa Al-Maliki
 */

declare(strict_types=1);

namespace Alaa\ScopeConfig\Console\Command;

use Alaa\ScopeConfig\Integration\Test;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class IntegrationTestCommand
 *
 * @package Alaa\ScopeConfig\Console\Command
 * @author  Alaa Al-Maliki <alaa.almaliki@gmail.com>
 */
class IntegrationTestCommand extends Command
{
    /**
     * @var Test
     */
    protected $integrationTest;

    /**
     * IntegrationTestCommand constructor.
     *
     * @param Test $integrationTest
     * @param string|null $name
     */
    public function __construct(
        Test $integrationTest,
        string $name = null
    ) {
        parent::__construct($name);
        $this->integrationTest = $integrationTest;
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        parent::configure();
        $this->setName('alaa:scope-config:test');
        $this->setDescription('Test scope config functionality.');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->integrationTest->test();
        $this->integrationTest->deleteTestData();
    }
}
