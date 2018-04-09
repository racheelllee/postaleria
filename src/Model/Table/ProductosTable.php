<?php
namespace App\Model\Table;

use App\Model\Entity\Producto;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;



/**
 * Productos Model
 */
class ProductosTable extends Table
{
    protected function _initializeSchema(\Cake\Database\Schema\Table $table)
    {
        $table->columnType('photo', 'proffer.file');
        return $table;
    }
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('productos');
        $this->displayField('nombre');
        $this->primaryKey('id');

        $this->addBehavior('Tree',['parent' => 'padre_id'  ]);
      
        $this->belongsTo('Users', [
            'foreignKey' => 'usuario_id'
        ]);
        $this->belongsTo('Proveedores', [
            'foreignKey' => 'proveedor_id'
        ]);
        $this->belongsTo('Marcas', [
            'foreignKey' => 'marca_id'
        ]);
        $this->belongsTo('productosEstatuses', [
            'foreignKey' => 'estatus_id'
        ]);
        $this->belongsTo('ProductoTipoFotos', [
            'foreignKey' => 'producto_tipo_foto_id'
        ]);
        $this->belongsTo('ProductoOrientaciones', [
            'foreignKey' => 'producto_orientacion_id'
        ]);



        $this->hasMany('DisenosSecundarios', [
            'foreignKey' => 'producto_id'
        ]);
        $this->hasMany('Atributos', [
            'foreignKey' => 'producto_id'
        ]);
        $this->hasMany('Cupones', [
            'foreignKey' => 'producto_id'
        ]);
        $this->hasMany('Imagenes', [
            'foreignKey' => 'producto_id',
            'sort' => ['orden'=>'ASC']
        ]);
        $this->hasMany('Preciocomeptencias', [
            'foreignKey' => 'producto_id'
        ]);
        $this->hasMany('Precios', [
            'foreignKey' => 'producto_id'
        ]);
        $this->belongsToMany('Categorias', [
            'foreignKey' => 'producto_id',
            'targetForeignKey' => 'categoria_id',
            'joinTable' => 'categorias_productos',
            'conditions' => 'Categorias.publicado = 1'
        ]);
        $this->belongsToMany('Promociones', [
            'foreignKey' => 'producto_id',
            'targetForeignKey' => 'promocion_id',
            'joinTable' => 'productos_promociones'
        ]);

         $this->hasMany('Comentarios', [
            'foreignKey' => 'producto_id',
             'conditions'=> 'Comentarios.autorizado= 1'
        ]);

        $this->belongsToMany('Complementos', [
            'className' => 'Productos',
            'foreignKey' => 'producto_id',
            'targetForeignKey' => 'complemento_id',
            'joinTable' => 'complementos_productos',
              'conditions'=> 'Complementos.estatus_id= 1'
        ]);

        $this->hasMany('CategoriasProductos', [
            'foreignKey' => 'producto_id'
        ]);

        $this->hasMany('OpcionefiltrosProductos', [
            'foreignKey' => 'producto_id'
        ]);
        
        $this->hasOne('ComplementosCategorias', [
            'foreignKey' => 'producto_id'
        ]);
        $this->hasMany('Fichas', [
            'foreignKey' => 'producto_id',
            'sort' => ['orden'=>'ASC']
        ]);

        $this->hasMany('PromocionProductos', [
            'foreignKey' => 'producto_id',
            'sort' => ['PromocionProductos.id'=>'DESC']
        ]);
        
        $this->addBehavior('Proffer.Proffer', [
            'photo' => [    // The name of your upload field
                'root' => WWW_ROOT . 'files', // Customise the root upload folder here, or omit to use the default
                'dir' => 'photo_dir',   // The name of the field to store the folder
                'thumbnailSizes' => [ // Declare your thumbnails
                    'square' => [   // Define the prefix of your thumbnail
                        'w' => 300, // Width
                        'h' => 300, // Height
                        'crop' => true,
                        'jpeg_quality'  => 100
                    ]
                ],
                'thumbnailMethod' => 'gd'   // Options are Imagick or Gd
            ]
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('url', [
              'unique' => ['rule' => 'validateUnique', 'provider' => 'table']
              ])
            ->requirePresence('url', 'create')
            ->notEmpty('url');

        $validator
            ->requirePresence('photo', 'create')
            ->allowEmpty('photo', 'update');
            
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        return $rules;
    }


    public function getOptionsForExcel(){

        $fields = [
            ['field' => 'sku', 'no_empty'=>false],
            ['field' => 'precio', 'no_empty'=>false],
            ['field' => 'ver_precio', 'no_empty'=>false],
            ['field' => 'precio_promocion', 'no_empty'=>false],
            ['field' => 'ver_precio_promocion', 'no_empty'=>false],
            ['field' => 'precio_meses_sin_intereses', 'no_empty'=>false],
            ['field' => 'ver_precio_meses_sin_intereses', 'no_empty'=>false],
            ['field' => 'meses_sin_intereses', 'no_empty'=>false],
            ['field' => 'ver_meses_sin_intereses', 'no_empty'=>false],
            ['field' => 'porcentaje_descuento_promocion', 'no_empty'=>false],
            ['field' => 'ver_porcentaje_descuento_promocion', 'no_empty'=>false],

            ['field' => 'categorias', 'no_empty'=>false],
            ['field' => 'nombre', 'no_empty'=>false],
            ['field' => 'url', 'no_empty'=>false],
            ['field' => 'descripcion_corta', 'no_empty'=>false],
            ['field' => 'descripcion_larga', 'no_empty'=>false],
            ['field' => 'meta_titulo', 'no_empty'=>false],
            ['field' => 'meta_descripcion', 'no_empty'=>false],
            ['field' => 'meta_keywords', 'no_empty'=>false],
            ['field' => 'complementos', 'no_empty'=>false]
        ];
        $headerCols = [];
        $notEmpty = [];

        foreach ($fields as $field) {
            $headerCols[] = $field['field'];
            if($field['no_empty']){
                $notEmpty[] = $field['field'];
            }
        }

        $options = [
                    'startRow'=>1,
                    'headerCols'=>$headerCols,
                    'notEmpty'=>$notEmpty,
                    'worksheetPosition'=>0
                    ];

        return $options;
    }

    public function validationExcel($productosArray = null){

        foreach ($productosArray as $key => $producto) {


            $productosArray[$key]['precio'] = preg_replace("/[^0-9\.]/","",$producto['precio']);
            $productosArray[$key]['precio_promocion'] = preg_replace("/[^0-9\.]/","",$producto['precio_promocion']);
            $productosArray[$key]['precio_meses_sin_intereses'] = preg_replace("/[^0-9\.]/","",$producto['precio_meses_sin_intereses']);
            $productosArray[$key]['meses_sin_intereses'] = preg_replace("/[^0-9\.]/","",$producto['meses_sin_intereses']);
            $productosArray[$key]['porcentaje_descuento_promocion'] = preg_replace("/[^0-9\.]/","",$producto['porcentaje_descuento_promocion']);

            $productosArray[$key]['ver_precio'] = (strtolower($producto['ver_precio']) == 'si')? true : false;
            $productosArray[$key]['ver_precio_promocion'] = (strtolower($producto['ver_precio_promocion']) == 'si')? true : false;
            $productosArray[$key]['ver_precio_meses_sin_intereses'] = (strtolower($producto['ver_precio_meses_sin_intereses']) == 'si')? true : false;
            $productosArray[$key]['ver_meses_sin_intereses'] = (strtolower($producto['ver_meses_sin_intereses']) == 'si')? true : false;
            $productosArray[$key]['ver_porcentaje_descuento_promocion'] = (strtolower($producto['ver_porcentaje_descuento_promocion']) == 'si')? true : false;

            $productosArray[$key]['categorias'] = (strtolower($producto['categorias']));
            $productosArray[$key]['nombre'] = (strtolower($producto['nombre']));
            $productosArray[$key]['url'] = (strtolower($producto['url']));
            $productosArray[$key]['descripcion_corta'] = (strtolower($producto['descripcion_corta']));
            $productosArray[$key]['meta_titulo'] = (strtolower($producto['meta_titulo']));
            $productosArray[$key]['meta_descripcion'] = (strtolower($producto['meta_descripcion']));
            $productosArray[$key]['meta_keywords'] = (strtolower($producto['meta_keywords']));
            $productosArray[$key]['complementos'] = (strtolower($producto['complementos']));


            if(!empty($producto['sku'])){

                $this->Productos = TableRegistry::get('Productos');
                $productUrl = $this->Productos->find('all', ['conditions'=>['Productos.url'=>$producto['url']]])->first();

                if($productUrl){
                    $productosArray[$key]['result_upload'][] = 'La Url Ya existe, Cambiela';
                }
                else{
                    $arrayCategorias = explode(", ", $productosArray[$key]['categorias']);
                    $arrayComplementos = explode(", ", $productosArray[$key]['complementos']);

                    foreach ($arrayCategorias as $k1 => $value) {
                        $categoria = TableRegistry::get('categorias')->find('all', ['conditions'=>['categorias.nombre'=>$value]])->first();
                        if(!$categoria){
                            $productosArray[$key]['result_upload'][] = 'La categoría '.$value.' no existe';
                            break;
                        }
                    }

                    foreach ($arrayComplementos as $k2 => $value) {
                        $complemento = TableRegistry::get('Productos')->find('all', ['conditions'=>['Productos.sku'=>$value]])->first();

                        if(!$complemento){
                            $productosArray[$key]['result_upload'][] = 'El complemento '. $value.' no existe';
                            break;
                        }
                    }

                }
            }

        }
        
        return $productosArray;
    }
}
