<?php

namespace QueridoDiario\Parser;

use Generator;

class Proccess
{
    /**
     * @var array<mixed>
     */
    private $config;
    /**
     * @var array<object>
     */
    private $spiders;
    public function __construct(array $config = [])
    {
        $this->config = $config ?? (new Config())->getConfig();
        $this->loadSpiders();
    }

    private function loadSpiders(): void
    {
        $this->spiders = $this->config['plugins'];
    }

    /**
     * @return void
     */
    public function collectData(): void
    {
        foreach ($this->spiders as $spider) {
            $instance = new $spider($this->config);
            $gazettes = $instance->collectData();
            foreach ($gazettes as $gazette) {
                $gazette->setConfig($this->config);
                $gazette->save();
            }
        }
    }
}
