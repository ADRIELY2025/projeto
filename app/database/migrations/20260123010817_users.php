<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration
{
    public function change(): void
    {
        // criação de tabela
        $table = $this->table('users', ['id' => false, 'primary_key' => ['id]]);']]);
        $table->addColumn('id', 'biginterger', ['identity' => true,'null' => false])
              ->addColumn('nome', 'text', ['null' => true])
              ->addColumn('salario', 'decimal', ['null' => true, 'default' => 0, 'precision' => 18, 'scale' => 4])
              ->addColumn('data_cadastro', 'datetime', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
              ->addColumn('data_atualização', 'datetime', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
              ->create();
        }
}
