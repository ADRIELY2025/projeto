<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration
{
    public function change(): void
    {
        // criação de tabela
        $users = $this->table('usuario');
        $users->addColumn('nome', 'string', ['limit' => 20])
              ->addColumn('cpf', 'string', ['limit' => 20])
              ->addColumn('senha', 'string', ['limit' => 40])
              ->addColumn('password_salt', 'string', ['limit' => 40])
              ->addColumn('email', 'string', ['limit' => 100])
              ->addColumn('primeiro_nome', 'string', ['limit' => 30])
              ->addColumn('sobre_nome', 'string', ['limit' => 30])
              ->addColumn('created', 'datetime')
              ->addColumn('updated', 'datetime', ['null' => true])
              ->addIndex(['username', 'email'], ['unique' => true])
              ->create();
        }
}
