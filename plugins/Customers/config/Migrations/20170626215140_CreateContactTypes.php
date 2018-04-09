<?php
use Migrations\AbstractMigration;

class CreateContactTypes extends AbstractMigration
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
        $table = $this->table('contact_types');
        $table->addColumn('name', 'string', [
            'default' => '',
            'limit' => 256,
            'null' => false,
        ]);
        $table->addColumn('label', 'string', [
            'default' => '',
            'limit' => 64,
            'null' => false,
        ]);
        $table->create();
    }
}
