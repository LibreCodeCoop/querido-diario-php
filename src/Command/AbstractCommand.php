<?php

namespace QueridoDiario\Command;

use QueridoDiario\Parser\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends Command
{
    /**
     * {@inheritDoc}
     *
     * @return void
     */
    protected function configure()
    {
        $this->addOption('--configuration', '-c', InputOption::VALUE_REQUIRED, 'The configuration file to load');
        $this->addOption('--parser', '-p', InputOption::VALUE_REQUIRED, 'Parser used to read the config file. Defaults to YAML');
    }

    /**
     * {@inheritDoc}
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$this->getConfig()) {
            $this->config = (new Config($input->getOption('configuration')??'', $input->getOption('parser')??''))->getConfig();
        }
    }

    /**
     * Gets the config.
     *
     * @return <array>
     */
    public function getConfig()
    {
        return $this->config;
    }
}