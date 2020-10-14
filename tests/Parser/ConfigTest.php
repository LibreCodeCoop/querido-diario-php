<?php

use PHPUnit\Framework\TestCase;
use QueridoDiario\Parser\Config;

class ConfigTest extends TestCase
{
    /**
     * @var Config
     */
    public $config;
    public function setUp(): void
    {
        $this->config = new Config();
    }
    public function testConfigIsLoaded()
    {
        $this->assertArrayHasKey('plugins', $this->config->getConfig());
    }
}