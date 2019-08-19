<?php
use Migrations\AbstractMigration;

class CreatePessoas extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('pessoas');
        $table->addColumn('nome', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('celular', 'string', [
            'default' => null,
            'limit' => 30,
            'null' => false,
        ]);
        $table->addColumn('cidade_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addForeignKey('cidade_id', 'cidade', 'id_cidade', ['delete' => 'CASCADE', 'update' => 'NO_ACTION']);
        $table->addIndex(['email'], ['unique' => true]);
        $table->addIndex(['celular'], ['unique' => true]);
        $table->create();
    }
}
