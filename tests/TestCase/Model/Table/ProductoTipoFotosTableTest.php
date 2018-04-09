<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductoTipoFotosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductoTipoFotosTable Test Case
 */
class ProductoTipoFotosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductoTipoFotosTable
     */
    public $ProductoTipoFotos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.producto_tipo_fotos',
        'app.productos',
        'app.users',
        'app.proveedores',
        'app.marcas',
        'app.productos_estatuses',
        'app.producto_orientaciones',
        'app.disenos_secundarios',
        'app.atributos',
        'app.opciones',
        'app.cupones',
        'app.imagenes',
        'app.preciocomeptencias',
        'app.precios',
        'app.categorias',
        'app.filtros',
        'app.opcionesfiltros',
        'app.opcionefiltros_productos',
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
        $config = TableRegistry::exists('ProductoTipoFotos') ? [] : ['className' => 'App\Model\Table\ProductoTipoFotosTable'];
        $this->ProductoTipoFotos = TableRegistry::get('ProductoTipoFotos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductoTipoFotos);

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
