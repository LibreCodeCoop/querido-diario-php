<?php

namespace QueridoDiario\Tests\mock\spiders;

use Generator;
use QueridoDiario\Parser\Gazette;
use QueridoDiario\Parser\ProccessAbstract;

class CollectorStub extends ProccessAbstract
{

    public function collectData(string $date = ''): Generator
    {
        foreach([1,2] as $gazzete) {
            yield new Gazette();
        }
    }
}