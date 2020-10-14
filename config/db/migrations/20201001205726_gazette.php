<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Util\Literal;

final class Gazette extends AbstractMigration
{
    public function change(): void
    {
        $this->table('gazette')
            ->addColumn('source_text', 'text')
            ->addColumn('date', 'date', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('metadata', 'json')
            ->addColumn('territory_id', 'integer')
            ->addForeignKey('territory_id', 'territory', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->create();
    }
}
