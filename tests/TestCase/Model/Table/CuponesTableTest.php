<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CuponesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CuponesTable Test Case
 */
class CuponesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CuponesTable
     */
    public $Cupones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cupones',
        'app.clientes',
        'app.categorias',
        'app.filtros',
        'app.opcionesfiltros',
        'app.opcionefiltros_productos',
        'app.productos',
        'app.users',
        'app.proveedores',
        'app.marcas',
        'app.productos_estatuses',
        'app.producto_tipo_fotos',
        'app.producto_orientaciones',
        'app.disenos_secundarios',
        'app.producto',
        'app.atributos',
        'app.opciones',
        'app.imagenes',
        'app.preciocomeptencias',
        'app.precios',
        'app.categorias_productos',
        'app.promociones',
        'app.promocion_productos',
        'app.productos_promociones',
        'app.comentarios',
        'app.complementos_categorias',
        'app.fichas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Cupones') ? [] : ['className' => 'App\Model\Table\CuponesTable'];
        $this->Cupones = TableRegistry::get('Cupones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cupones);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
