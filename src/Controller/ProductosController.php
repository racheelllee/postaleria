<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\Network\Email\Email;
use PDF_Code128; 
use MP;
use Cake\ORM\TableRegistry;

use Cake\Routing\Router;

/**
 * Productos Controller
 *
 * @property \App\Model\Table\ProductosTable $Productos
 */
class ProductosController extends AppController
{   
    public $components = ['Usermgmt.Search'];

    public $helpers = ['Usermgmt.Tinymce', 'Usermgmt.Ckeditor'];

    public $paginate = [
    // Other keys here.
    'limit' => 50
    ];


    public $searchFields = [
        'index'=>[
            'Productos'=>[
                'Productos'=>[
                    'type'=>'text',
                    'label'=>'Search',
                    'tagline'=>'nombre, usuario, email',
                    'condition'=>'multiple',
                    'searchFields'=>['Productos.nombre'],
                    'inputOptions'=>['style'=>'width:200px;']
                ],
                'Productos.cat_id'=>[
                    'type'=>'select',
                    'label'=>'Categorias',
                    'model'=>'Categorias',
                    'selector'=>'GetCategorias',
                    'inputOptions'=>['class'=>'select-simple form-control']
                ]
            ]
        ]
    ];

    public $categoria_id = null;

    public function beforeFilter(\Cake\Event\Event $event){
        parent::beforeFilter($event);


        $sesion= $this->request->session();
        $var = $sesion->read('UserAuth.Search.Productos.index');
      
        if($this->request->params['action'] == 'index'){
            if(isset($this->request->data['Productos']['cat_id'])){
               
               $this->categoria_id = $this->request->data['Productos']['cat_id'];
               unset($this->request->data['Productos']['cat_id']);
           }else{
                $sesion->delete('UserAuth.Search.Productos.index.Productos.cat_id');
                $this->categoria_id = $var['Productos']['cat_id'];
           }
        }

        if(isset($this->request->data['search_clear']) && $this->request->data['search_clear'] ==1){
               $this->categoria_id = '';
        }



    }


    public function index()
    {   
        $this->paginate = ['limit'=>10, 'order'=>['Productos.id'=>'DESC']];
        $this->Search->applySearch();
        $this->paginate = [
            'contain' => ['ProductoTipoFotos', 'ProductoOrientaciones', 'productosEstatuses', 'Categorias']
        ];
        $productos = $this->paginate($this->Productos)->toArray();


        $tipoFotos = $this->Productos->ProductoTipoFotos->find('list', ['limit' => 200]);
        $orientaciones = $this->Productos->ProductoOrientaciones->find('list', ['limit' => 200]);
       
        $this->set(compact('productos','tipoFotos', 'orientaciones'));
        if($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Element/all_productos');
        }
    }


    public function add()
    {
        $producto = $this->Productos->newEntity();

        if ($this->request->is('post')) {
            $producto = $this->Productos->patchEntity($producto, $this->request->data);

            if($producto['activo'] == true){
                $producto['fecha_publicacion'] = date('Y-m-d H:m:s');
            }
            
            $producto['meta_titulo'] = $producto['nombre'];
            $producto['usuario_id'] =  $this->UserAuth->getUserId();
            $producto['nombre'] = $this->request->data['nombre'] ;
            $producto['sku'] = $this->request->data['codigo'] ;
            $producto['producto_tipo_foto_id'] = $this->request->data['producto_tipo_foto_id'] ;
            $producto['tipo'] = $this->request->data['tipo'] ;
            $producto['producto_orientacion_id'] = 1;//$this->request->data['producto_orientacion_id'] ;
            $producto['color'] = $this->request->data['color'] ;
            $producto['texto'] = $this->request->data['texto'] ;
            $producto['photo'] = $this->request->data['photo'] ;
            $producto['estatus_id'] = 1 ;

            if ($this->Productos->save($producto)) {
               $this->Flash->success(__('El producto se guardo.'));
                return $this->redirect('/productos/edit/'.$producto->id);
            } else {
                $this->Flash->error(__('La producto no se pudo guardar.'));
            }
        }

        $estatus = $this->Productos->ProductosEstatuses->find('list');
        $tipoFotos = $this->Productos->ProductoTipoFotos->find('list');
        $orientaciones = $this->Productos->ProductoOrientaciones->find('list');
        
        $this->set(compact('estatus', 'producto', 'tipoFotos', 'orientaciones'));
        $this->set('_serialize', ['producto']);
    }

    public function url_existente()
    {
        if ($this->request->is('post')) {

            $busca_url = $this->Productos->find('all', ['conditions' => ['Productos.url' => $this->request->data['url']]])->first();

            die(json_encode(count($busca_url)));
        }
    }

    public function edit($id = null)
    {
        $producto = $this->Productos->get($id, ['contain'=>['PromocionProductos.Promociones']]);
        $diseno_sec = $this->Productos->DisenosSecundarios->find('all')->where(['producto_id'=>$id])->toArray();
        $anteriorPhoto = $producto->photo;
        $flagEmpty= empty($diseno_sec);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $producto = $this->Productos->patchEntity($producto, $this->request->data);


            if($producto['activo'] == true){
                $producto['fecha_publicacion'] = date('Y-m-d H:m:s');
            }
            $producto['sku'] = $this->request->data['codigo'] ;
            $producto['producto_orientacion_id'] = 1;//$this->request->data['producto_orientacion_id'] ;
            $producto['estatus_id'] = 1 ;

            if($this->request->data['photo']['error'] == 0){//si no viene vacio
                $producto['photo']= $this->request->data['photo'];
            }else{//si viene vacio se le asigna la que tenia antes
                $producto['photo']= $anteriorPhoto;
            }
                // debug($this->request->data['images']);
                // die();
            if ($this->Productos->save($producto)) {
                $producto_id = $producto->id;
                // if(($this->request->data['images']['error'] == 0)){
                    foreach ($this->request->data['images'] as $key => $image) {
                        $this->loadModel('DisenosSecundarios');
                        $disenoSecundario = $this->DisenosSecundarios->newEntity();
                        $disenoSecundario->producto_id = $producto_id;
                        $disenoSecundario->image = $image;
                        $this->DisenosSecundarios->save($disenoSecundario);
                    }
                // }
                $this->Flash->success(__('Los cambios del producto se guardaron.'));
                return $this->redirect('/productos/edit/'.$id);
            } else {
                $this->Flash->error(__('No se pudo guardar los cambios del producto.'));
            }
        }
       

        $categorias = $this->Productos->Categorias->find('treeList', ['spacer' => '-']);
        $categoria_relacionada = $this->Productos->ComplementosCategorias->find('all')->where(['producto_id'=>$id])->first();
        $tipoFotos = $this->Productos->ProductoTipoFotos->find('list');
        $orientaciones = $this->Productos->ProductoOrientaciones->find('list');

        $this->set(compact('producto', 'categorias', 'categoria_relacionada','tipoFotos', 'orientaciones', 'flagEmpty', 'diseno_sec'));//, 'diseno_sec'));
        $this->set('_serialize', ['producto']);
    }

     public function cargaMasiva(){

        $productosArray = [];
        $productosFile = '';

        if ($this->request->is(['patch', 'post', 'put'])) {

            if(isset($this->request->data['upload-file']) && move_uploaded_file($this->request->data['upload-file']['tmp_name'], TMP.$this->request->data['upload-file']['name'])){

                $this->Productos->addBehavior('ImportExcel');

                $file =  TMP.$this->request->data['upload-file']['name'];

                $options = $this->Productos->getOptionsForExcel();
                
                $productosArray = $this->Productos->prepareArrayData($file, $options);               
                $productosArray = $this->Productos->validationExcel($productosArray);

                $productosFile = $file;
            }
        }

        $this->set(compact('productosArray', 'productosFile'));
        $this->set('_serialize', ['productos']);
    }

    public function addProducts(){
        if ($this->request->is(['patch', 'post', 'put'])) {

            if(!empty($this->request->data['productosFile'])){

                $this->Productos->addBehavior('ImportExcel');

                $file =  $this->request->data['productosFile'];

                $options = $this->Productos->getOptionsForExcel();
                $productosArray = $this->Productos->prepareArrayData($file, $options);
                $productosArray = $this->Productos->validationExcel($productosArray);

                foreach ($productosArray as $key => $product) {

                    $productoSearch = $this->Productos->find('all', ['conditions'=>['Productos.sku'=>$product['sku']]])->first();

                    if (!$productoSearch) {
                        $producto = $this->Productos->newEntity();
                        $producto = $this->Productos->patchEntity($producto, $product);
                    }else{
                        $producto = $this->Productos->patchEntity($productoSearch, $product);
                    }

                    if($producto->ver_precio || $producto->ver_precio_promocion){
                        $producto->precio_real = ($producto->ver_precio_promocion)? $producto->precio_promocion : $producto->precio;
                    }else{
                        $producto->precio_real = 0;
                    }

                    if ($this->Productos->save($producto)) {

                        $arrayCategorias = explode(", ", $product['categorias']);
                        $arrayComplementos = explode(", ", $product['complementos']);

                        foreach ($arrayCategorias as $key => $value) {
                            $categoria = TableRegistry::get('categorias')->find('all', ['conditions' => ['categorias.nombre' => $value]])->first();

                            $categorias_productos = TableRegistry::get('categorias_productos');
                            $cat_pro = $categorias_productos->newEntity();

                            $cat_pro->categoria_id = $categoria->id;
                            $cat_pro->producto_id = $producto->id;

                            $categorias_productos->save($cat_pro);
                        }

                        foreach ($arrayComplementos as $key => $value) {
                            $complemento = TableRegistry::get('Productos')->find('all', ['conditions'=>['Productos.sku'=>$value]])->first();

                            $complementos_productos = TableRegistry::get('complementos_productos');
                            $com_pro = $complementos_productos->newEntity();

                            $com_pro->complemento_id = $complemento->id;
                            $com_pro->producto_id = $producto->id;

                            $complementos_productos->save($com_pro);
                        }
                    }
                }
            }
        }

        return $this->redirect(['action' => 'cargaMasiva']);
    }
    

    public function productos()
    {
        $productos = $this->Productos->find('all')->where(['Productos.deleted' => false])->toArray();      

        foreach ($productos as $key => $prod) {
            $categorias_productos = TableRegistry::get('categorias_productos')->find('all', ['conditions' => ['categorias_productos.producto_id' => $prod['id']]])->toArray();
            $complementos_productos = TableRegistry::get('complementos_productos')->find('all', ['conditions' => ['complementos_productos.producto_id' => $prod['id']]])->toArray();            

            foreach ($categorias_productos as $value) {
                $categorias = TableRegistry::get('categorias')->find('all', ['conditions' => ['categorias.id' => $value->categoria_id]])->first();                
                $productos[$key]['categorias'] .= $categorias['nombre'].", ";
            }           

            foreach ($complementos_productos as $k2 => $value) {
                $complemento = TableRegistry::get('Productos')->find('all', ['conditions'=>['Productos.id'=>$value->complemento_id]])->first();
                $productos[$key]['complementos'] .= $complemento['sku'].", ";
            }
        }       

        $this->helpers = ['Cewi/Excel.Excel'=>[]];

        $this->set(compact('productos'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $producto = $this->Productos->get($id);
        $producto->deleted = true;
        if ($this->Productos->save($producto)) {
            $this->Flash->success(__('El producto fue borrado.'));
        } else {
            $this->Flash->error(__('El producto no se pudo borrar. Intentalo de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function setInactive($id = null)
    {
        $this->request->allowMethod(['post']);

        $producto = $this->Productos->get($id);
        $producto->activo = false;
        $producto->estatus_id = false;

        $this->Productos->save($producto);
        $this->Flash->success(__('El producto quedo inactivo.'));

        return $this->redirect(['action' => 'index']);
    }

    public function setActive($id = null)
    {
        $this->request->allowMethod(['post']);
        
        $producto = $this->Productos->get($id);
        $producto->activo = true;
        $producto->estatus_id = true;

        $this->Productos->save($producto);
        $this->Flash->success(__('El producto quedo activo.'));

        return $this->redirect(['action' => 'index']);
    }


    /*----- FRONT ------*/

    public function detalle($url = null,$comentario =null)
    {   
        
        $this->loadModel('Categorias');
        $datos = $this->Categorias->datosGenerales();
        $this->set('categorias', $datos['categorias']);
        $this->set('banners', $datos['banners']);
        $this->set('promociones', $datos['promociones']);

        $this->loadModel('Promociones');
        $time = Time::now(DEFAULT_TIME_ZONE);
        $promociones = $this->Promociones->find('list', [
                    'keyField'=>'id', 'valueField'=>'id',
                    'contain' => [],
                    'conditions' => [
                            '"'.$time->format('Y-m-d').'" BETWEEN DATE(Promociones.vigencia_inicio) AND DATE(Promociones.vigencia_fin)',
                            'Promociones.deleted' => false, 
                            'Promociones.status' => true, 
                    ] ])->toArray();

        $promociones[] = 0;
        
        $producto = $this->Productos->find('all')
            ->contain(['Imagenes','Promociones','Atributos.Opciones','Complementos.Imagenes','Categorias.Productos.Imagenes','Marcas','ComplementosCategorias','Comentarios','Fichas', 'PromocionProductos'=>['conditions'=>['PromocionProductos.promocion_id IN'=>$promociones]],
                'Complementos.PromocionProductos'=>['conditions'=>['PromocionProductos.promocion_id IN'=>$promociones]],
                'Categorias.Productos.PromocionProductos'=>['conditions'=>['PromocionProductos.promocion_id IN'=>$promociones]]

                ])
            ->where(['Productos.url' => $url])
            ->first();

        if($producto->promocion_productos){
            unset($producto->promocion_productos[0]['id']);
            unset($producto->promocion_productos[0]['promocion_id']);
            unset($producto->promocion_productos[0]['producto_id']);
           
            foreach ($producto->promocion_productos[0]->toArray() as $key => $value) {
                $producto[$key] = $value;
            }
        }

        if($producto->complementos){
            foreach ($producto->complementos as $k => $complemento) {
                if($producto->complementos[$k]->promocion_productos){
                    unset($producto->complementos[$k]->promocion_productos[0]['id']);
                    unset($producto->complementos[$k]->promocion_productos[0]['promocion_id']);
                    unset($producto->complementos[$k]->promocion_productos[0]['producto_id']);
                   
                    foreach ($producto->complementos[$k]->promocion_productos[0]->toArray() as $key => $value) {
                        $producto->complementos[$k][$key] = $value;
                    }
                }
            }
        }

        if($producto->categorias){
            foreach ($producto->categorias as $c => $categoria) {
                foreach ($producto->categorias[$c]->productos as $k => $producto_categoria) {
                    if($producto->categorias[$c]->productos[$k]->promocion_productos){
                        unset($producto->categorias[$c]->productos[$k]->promocion_productos[0]['id']);
                        unset($producto->categorias[$c]->productos[$k]->promocion_productos[0]['promocion_id']);
                        unset($producto->categorias[$c]->productos[$k]->promocion_productos[0]['producto_id']);
                       
                        foreach ($producto->categorias[$c]->productos[$k]->promocion_productos[0]->toArray() as $key => $value) {
                            $producto->categorias[$c]->productos[$k][$key] = $value;
                        }
                    }
                }
            }
        }

        if(count( $producto->categorias[0]->productos->where  > 0)){
            $existe = array();
            foreach ($producto->categorias[0]->productos as $key => $value) {
                        
                if( in_array( $value->id  , $existe)){

                    unset($producto->categorias[0]->productos[$key]);

                }else{
                    $existe[] =  $value->id ;

                }
                    
            }
        }
        
        if(isset($producto->complementos_categoria->categoria_id)){
                
            $conditions['AND'][]= array('Productos.estatus_id in (1,3)');
            $conditions['AND'][]= array('Productos.precio>0');
                
            $categoria=$producto->complementos_categoria->categoria_id;
            $busqueda_productos = $this->Productos->find('all', 
                    ['conditions'=>$conditions, 'contain'=>['CategoriasProductos','Imagenes']])
                ->matching('CategoriasProductos', function ($q) use ($categoria) {
                return $q->where(['CategoriasProductos.categoria_id' => $categoria]);
                })->toArray();
                
            foreach($busqueda_productos as $p){
                array_push($producto->complementos,$p);
            }

        }

        $similares=$producto->categorias[0]->productos;
        shuffle($similares);
        $similares = array_slice($similares, 0, 20);
        $this->set('similares',$similares);   

        $ruta = Router::url(null, true); 
        $this->set('ruta',$ruta);    
        
        $this->set('comentariorecibo',$comentario);    
        $this->set('producto', $producto);
        $this->set('_serialize', ['producto']);
        $this->set('hoy',new Time());
        $this->render(null,'front');
    }


 

    public function buscar($buscar= null, $marca = null)
    {

        $this->loadModel('Categorias');
        $datos = $this->Categorias->datosGenerales();
        $this->set('categorias', $datos['categorias']);
        $this->set('banners', $datos['banners']);
        $this->set('promociones', $datos['promociones']);

        if(!$buscar){
            $this->request->data['data']['Producto']['buscar'] = str_replace(array('<', '>', '&', '{', '}', '*','/','-detail'), array('-'), $this->request->data['data']['Producto']['buscar']);
            $this->redirect('/productos/buscar/'.urlencode($this->request->data['data']['Producto']['buscar']));
        }

        if($buscar){
            $buscar = str_replace(array('<', '>', '&', '{', '}', '*','/','-detail'), array('-'), $buscar);
    
            $this->request->data['data']['Producto']['buscar']= $buscar;

        } 

        $cat = $this->Productos->Categorias->find('list', ['keyField'=>'id', 'valueField'=>'id'])
            ->where(['Categorias.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%"'])->toArray();

        $this->loadModel('CategoriasProductos');
        $catProductos = $this->CategoriasProductos->find('list', ['keyField'=>'id', 'valueField'=>'producto_id'])
            ->where(['CategoriasProductos.categoria_id IN'=>($cat)? $cat : ['']])->toArray();


        if(isset($this->request->data['data']['Producto']) && $this->request->data['data']['Producto']['buscar']){

            $this->loadModel('Promociones');
            $time = Time::now(DEFAULT_TIME_ZONE);
            $promociones = $this->Promociones->find('list', [
                        'keyField'=>'id', 'valueField'=>'id',
                        'contain' => [],
                        'conditions' => [
                                '"'.$time->format('Y-m-d').'" BETWEEN DATE(Promociones.vigencia_inicio) AND DATE(Promociones.vigencia_fin)',
                                'Promociones.deleted' => false, 
                                'Promociones.status' => true, 
                        ] ])->toArray();

            $promociones[] = 0;
            
            $productos = $this->Productos->find('all')
                   ->contain(['PromocionProductos'=>['conditions'=>['PromocionProductos.promocion_id IN'=>$promociones]], 'Imagenes'])
                   ->where([
                            'OR'=>[
                                'Productos.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%"',
                                'Productos.descripcion_corta like "%'.$this->request->data['data']['Producto']['buscar'].'%"',
                                'Productos.descripcion_larga like "%'.$this->request->data['data']['Producto']['buscar'].'%"',
                                'Productos.sku like "%'.$this->request->data['data']['Producto']['buscar'].'%"',
                                'Productos.meta_keywords like "%'.$this->request->data['data']['Producto']['buscar'].'%"',
                                'Productos.meta_descripcion like "%'.$this->request->data['data']['Producto']['buscar'].'%"',
                                'Productos.meta_titulo like "%'.$this->request->data['data']['Producto']['buscar'].'%"',
                                'Productos.id IN' => ($catProductos)? $catProductos : ['']
                            ],

                            'Productos.estatus_id'=>1
                        ]);


            $this->set('buscar', $buscar);
            $this->set('marca_id', $marca);
            $this->set('marcas', $marcas);
            $this->set('productos', $productos);
            $this->set('_serialize', ['productos']);
            ///$this->render('../Categorias/subcategoria','front');
            $this->render(null,'front');

        }else{

            $this->redirect('/');
        }

      
    }


    public function buscarlista($buscar= null, $marca = null)
    {


        if($buscar){
            $this->request->data['data']['Producto']['buscar']= $buscar;
        }

     
        
        $this->loadModel('Categorias');
        $datos = $this->Categorias->datosGenerales();
        $this->set('categorias', $datos['categorias']);
        $this->set('banners', $datos['banners']);
        $this->set('promociones', $datos['promociones']);




        if($this->request->data['data']['Producto']['buscar'] or $this->request->data['data']['Producto']['buscar']=="-1"){

            if($marca){
                if($this->request->data['data']['Producto']['buscar']=="-1"){
                    $productos = $this->Productos->find('all')
                       ->contain(['Imagenes', 'Marcas', 'Atributos.Opciones'])
                       ->where(function ($exp, $q) {
                            return $exp->isNull('padre_id');
                         })
                       ->where(['Marcas.id = '.$marca,'Productos.estatus_id'=>1]);
                        $this->set('productos', $this->paginate($productos));

                }else{

                    $productos = $this->Productos->find('all')
                       ->contain(['Imagenes', 'Marcas', 'Atributos.Opciones'])
                       ->where(function ($exp, $q) {
                            return $exp->isNull('padre_id');
                        })
                       ->where(['(Productos.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.sku like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Marcas.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%" ) and Marcas.id = '.$marca,'Productos.estatus_id'=>1]);
                    $this->set('productos', $this->paginate($productos));
                }
                

            }else{

                $productos = $this->Productos->find('all')
                   ->contain(['Imagenes', 'Marcas', 'Atributos.Opciones'])
                   ->where(function ($exp, $q) {
                        return $exp->isNull('padre_id');
                    })
                   ->where(['((Productos.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Productos.sku like "%'.$this->request->data['data']['Producto']['buscar'].'%" or Marcas.nombre like "%'.$this->request->data['data']['Producto']['buscar'].'%")  or Marcas.nombre = "'.$buscar.'") and Productos.estatus_id=1']);
                $this->set('productos', $this->paginate($productos));
            }

       
            $marcas = array();
            foreach ($productos as $key => $producto) {
                $marcas[$producto['marca']['nombre']] = $producto['marca']['id'];
            }

        }else{

            //error 

          //  $this->Flash->error('La busqueda no pudo realizarse');
        }

        $this->set('buscar', $buscar);
        $this->set('marca_id', $marca);
        $this->set('marcas', $marcas);
        $this->set('_serialize', ['productos']);
        $this->render(null,'front');
    }



    public function carrito()
    {
        $this->loadModel('Categorias');
        $datos = $this->Categorias->datosGenerales();
        $this->set('categorias', $datos['categorias']);
        $this->set('banners', $datos['banners']);
        $this->set('promociones', $datos['promociones']);


        $carrito = [];
        if($this->request->session()->check('carrito')) { 
            $carrito = $this->request->session()->read('carrito');
        }
        //$carrito = $this->request->session()->destroy('carrito');
//debug($carrito); die;
        $this->set(compact('carrito'));
        $this->render(null,'front');
    }

    


    public function agregar_carrito()
    {
        if ($this->request->is('ajax')) { 

            $id_producto = $this->request->data['id_producto'];    
            $cantidad = $this->request->data['cantidad'];


            $this->loadModel('Promociones');
            $time = Time::now(DEFAULT_TIME_ZONE);
            $promociones = $this->Promociones->find('list', [
                        'keyField'=>'id', 'valueField'=>'id',
                        'contain' => [],
                        'conditions' => [
                                '"'.$time->format('Y-m-d').'" BETWEEN DATE(Promociones.vigencia_inicio) AND DATE(Promociones.vigencia_fin)',
                                'Promociones.deleted' => false, 
                                'Promociones.status' => true, 
                        ] ])->toArray();

            $promociones[] = 0;

            // datos de producto
            $producto = $this->Productos->get($id_producto, [
                'fields'=>['id', 'nombre', 'url', 'ver_precio', 'precio', 'ver_precio_promocion', 'precio_promocion', 'ver_meses_sin_intereses', 'precio_meses_sin_intereses', 'meses_sin_intereses', 'ver_porcentaje_descuento_promocion', 'porcentaje_descuento_promocion'],
                'contain'=>['Imagenes', 'PromocionProductos'=>['conditions'=>['PromocionProductos.promocion_id IN'=>$promociones]]]
            ]);

            if($producto->promocion_productos){
                unset($producto->promocion_productos[0]['id']);
                unset($producto->promocion_productos[0]['promocion_id']);
                unset($producto->promocion_productos[0]['producto_id']);
               
                foreach ($producto->promocion_productos[0]->toArray() as $key => $value) {
                    $producto[$key] = $value;
                }
            }



            $carrito = [];
            $ids_carrito = [];
            if($this->request->session()->check('carrito')) { 
                $carrito = $this->request->session()->read('carrito');

                foreach ($carrito as $key => $product) {
                    $ids_carrito[] = $product['id'];
                }
 
                if(in_array($id_producto, $ids_carrito)){

                    $response = [];
                    $response['text'] = $producto->nombre . ' ya existe en wishlist';
                    $response['cant'] = count($carrito);
                    
                    die(json_encode($response));
                }
            }



            // Evitamos que cheque si tienes hijos.
            $producto->checkgroup = FALSE; 


            $posicion = count($carrito);
            $carrito[$posicion] = $producto->toArray();
            $carrito[$posicion]['cantidad'] = $cantidad;

        
            $this->request->session()->write('carrito', $carrito);

            $response = [];
            $response['text'] = $producto->nombre . ' se agrego al wishlist';
            $response['cant'] = count($carrito);
            
            die(json_encode($response));

        }
    }

    public function editar_carrito()
    {   
        
        if ($this->request->is('ajax')) { 

            $accion=$this->request->data['accion'];
            $posicion=$this->request->data['posicion'];

            $carrito = [];
            if($this->request->session()->check('carrito')) { 
                $carrito = $this->request->session()->read('carrito');
            }

            if($accion == 'editar_articulo')
            {

                $carrito[$posicion]['cantidad'] = $this->request->data['cantidad'];

            }else if($accion == 'eliminar_articulo'){ 

                unset($carrito[$posicion]);
                $carrito = array_values($carrito);
            }

            $this->request->session()->write('carrito', $carrito);
            $carrito = $this->request->session()->read('carrito');
            
            die(json_encode($carrito)); 
        }
       
    }

    

    public function img($url = null)
    {
           $image = WWW_ROOT."img/no_image_available.png";

           $producto = $this->Productos->find('all')
            ->contain(['Imagenes'])
            ->where(['Productos.url' => $url])
            ->limit(1);
         $prod=$producto->toArray();
         //debug($prod[0]->imagenes);

         
         if(is_array($prod[0]->imagenes) && (isset($prod[0]->imagenes[0])) && (!is_null($prod[0]->imagenes[0]->nombre)) && ($prod[0]->imagenes[0]->nombre != "") ){

            $image = WWW_ROOT."producto_files/".$prod[0]->imagenes[0]->nombre;
         }
        //debug($image);
        //die;

        $imginfo = getimagesize($image);
        //header("Content-type: ".$imginfo['mime']);


        header('Content-Type: image/png');

        // Get new dimensions
        $filename=$image;
        $width = 120;
        $height = 120;

        list($width_orig, $height_orig) = getimagesize($filename);

        $ratio_orig = $width_orig/$height_orig;

        if ($width/$height > $ratio_orig) {
           $width = $height*$ratio_orig;
        } else {
           $height = $width/$ratio_orig;
        }

        // Resample
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefrompng($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        // Output
        imagepng($image_p);
        imagedestroy($im);


        //readfile($image);
        die;
        
    }


     public function cargaMasivaImg()
    {

        if ($this->request->is(['patch', 'post', 'put'])) {

            if($this->request->is('ajax')) {

                if($this->request->data['file']['error'] == 0 &&  $this->request->data['file']['size'] > 0){

                    $ext = explode(".", $this->request->data['file']['name']);
                    $nombre =  $this->request->data['file']['name'];
                    $destino = WWW_ROOT.'upload/productos/'.$nombre;

                    $tmp = $this->request->data['file']['tmp_name'];

                    $nameArray[] = explode("_", $nombre, 2);
                    $sku = $nameArray[0][0];


                    $producto = TableRegistry::get('productos')->find('all', ['conditions' => ['productos.sku' => $sku]])->first();

                    if ($producto) {

                        if (move_uploaded_file($tmp, $destino)) {

                            $imagen = TableRegistry::get('imagenes')->newEntity();

                            $imagen['producto_id'] = $producto->id;
                            $imagen['nombre'] = $nombre;
                            $imagen['nombre_real'] = $this->request->data['file']['name'];
                            $imagen['size'] = $this->request->data['file']['size'];

                            TableRegistry::get('imagenes')->save($imagen);

                            die(json_encode($imagen->id));
                        }
                    }else{

                    }

                }

            }

        }


        $producto = TableRegistry::get('productos')->find('all')->toArray();

        $this->set('producto');
        $this->set('_serialize', ['producto']);

    }


    


}
