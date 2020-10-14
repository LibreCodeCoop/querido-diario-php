<?php

namespace QueridoDiario\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProccessCommand extends AbstractCommand
{
    protected static $defaultName = 'proccess';

    protected function configure()
    {
        parent::configure();
        $this
            ->setDescription('Proccess all spiders')
            ->setHelp('This command proccess all spiders');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);
        $output->writeln('Proccessed!');
        return Command::SUCCESS;
    }
}