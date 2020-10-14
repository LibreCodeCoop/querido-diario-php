<?php

namespace QueridoDiario\Tests;

use PHPUnit\Framework\TestCase;
use QueridoDiario\Command\ProccessCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new ProccessCommand());

        $command = $application->find('proccess');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            '--configuration' => realpath(__DIR__ . '/../mock/config/scrapper.php')
        ]);
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Proccessed!', $output);
    }
}