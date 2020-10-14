<?php

use PHPUnit\Framework\TestCase;
use QueridoDiario\Parser\Config;
use QueridoDiario\Parser\Proccess;

class ProccessTest extends TestCase
{
    /**
     * @var Proccess
     */
    public $proccess;
    public function setUp(): void
    {
        $config = new Config(
            realpath(__DIR__ . '/../mock/config/scrapper.php')
        );
        $this->proccess = new Proccess($config->getConfig());
    }

    public function testCollectDataReturnGeneratorWithOneElement()
    {
        $this->markTestSkipped();
        $actual = $this->proccess->collectData();
        $this->assertEquals(1, iterator_count($actual));
    }

    public function testScrapperReturnCollection()
    {
        $this->markTestSkipped();
        $collect = $this->proccess->collectData();
        foreach ($collect as $scrapper) {
            $this->assertIsObject($scrapper);
        }
    }
}
