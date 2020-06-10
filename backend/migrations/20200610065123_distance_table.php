<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Util\Literal;

class DistanceTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('distance');
        $table
            ->addColumn('date', 'datetime', ['timezone' => true,
                'default' => Literal::from('now()')])
            ->addColumn('name', 'string', ['limit' => 50, 'null' => false])
            ->addColumn('quantity', 'integer', ['signed' => false, 'null' => false, 'default' => 1])
            ->addColumn('distance', 'integer', ['signed' => false])
            ->create();
    }

    public function down()
    {
        if ($this->hasTable('distance')) {
            $this->table('distance')->drop()->save();
        }
    }
}
