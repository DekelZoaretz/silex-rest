<?php

use Phinx\Migration\AbstractMigration;

class UsersMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        // create the table
        $table = $this->table('users', array('id' => false, 'primary_key' => 'id'));
        $table->addColumn('id', 'integer', array('identity' => true))
            ->addColumn('first_name', 'string')
            ->addColumn('last_name', 'string')
            ->addColumn('mobile', 'string')
            ->addColumn('email', 'string')
            ->addColumn('unit', 'string', array('null' => true))
            ->addColumn('birth_date', 'date', array('null' => true))
            ->addColumn('about_me', 'string', array('null' => true))
            ->addColumn('experience', 'string', array('null' => true))
            ->addColumn('external_web_site', 'string', array('null' => true))
            ->addColumn('created_at', 'timestamp');

        $table->addIndex(array('mobile'), array('unique' => true));
        $table->create();

    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->execute('DROP TABLE users');
    }
}
