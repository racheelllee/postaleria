<?php
use Migrations\AbstractMigration;

class AddRfcToCustomers extends AbstractMigration
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
        $table = $this->table('customers');
        $table->addColumn('rfc', 'string', [
            'default' => '',
            'limit' => 256,
            'null' => false,
        ]);
        $table->update();
    }
}
