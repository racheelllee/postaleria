<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DisenosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DisenosTable Test Case
 */
class DisenosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DisenosTable
     */
    public $Disenos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.disenos',
        'app.disenos_secundarios',
        'app.fotos_diseno'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Disenos') ? [] : ['className' => 'App\Model\Table\DisenosTable'];
        $this->Disenos = TableRegistry::get('Disenos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Disenos);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
