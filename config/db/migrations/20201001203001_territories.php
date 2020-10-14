<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Territories extends AbstractMigration
{
    public function change(): void
    {
        $this->table('territory')
            ->addColumn('name', 'string')
            ->addColumn('state_code', 'string', ['limit' => 2])
            ->addColumn('state', 'string')
            ->create();
    }
}
