<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cupones Controller
 *
 * @property \App\Model\Table\CuponesTable $Cupones
 */
class CuponesController extends AppController
{

    public $helpers = ['Usermgmt.Tinymce', 'Usermgmt.Ckeditor','Usermgmt.Search'];

    public $components = ['Usermgmt.Search'];

    public $searchFields = [
        'index'=>[
            'Cupones'=>[
                'Cupones'=>[
                    'position' => 'busqueda',
                    'type'=>'text',
                    'label'=>'Buscar',
                    'tagline'=>false,
                    'condition'=>'multiple',
                    'searchFields'=>['Cupones.nombre', 'Cupones.codigo'],
                    'inputOptions'=>['style'=>'width:300px;']
                ]
            ]
        ]
    ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $cupone = $this->Cupones->newEntity();
        $this->Search->applySearch();
        $this->paginate = [
            'contain' => ['Clientes', 'Categorias', 'Marcas', 'Productos']
        ];
        $cupones = $this->paginate($this->Cupones);
        $clientes = $this->Cupones->Clientes->find('list', ['limit' => 200]);
        $categorias = $this->Cupones->Categorias->find('list', ['limit' => 200]);
        $marcas = $this->Cupones->Marcas->find('list', ['limit' => 200]);
        $productos = $this->Cupones->Productos->find('list', ['limit' => 200]);
        $dependencies = ['cupone', 'clientes', 'categorias', 'marcas', 'productos'];
        $this->set(compact('cupone', 'cupones', 'clientes', 'categorias', 'marcas', 'productos'));
        $this->set('_serialize', ['cupones']);
        if($this->request->is('ajax')) {
            $this->viewBuilder()->layout('ajax');
            $this->render('/Element/all_cupones');
        }
    }

    /**
     * View method
     *
     * @param string|null $id Cupone id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cupone = $this->Cupones->get($id, [
            'contain' => ['Clientes', 'Categorias', 'Marcas', 'Productos']
        ]);

        $this->set('cupone', $cupone);
        $this->set('_serialize', ['cupone']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cupon = $this->Cupones->newEntity();
        if ($this->request->is('post')) {
            $cupon = $this->Cupones->patchEntity($cupon, $this->request->data);
            $cupon->fecha_inicio = date("Y-m-d H:i:s", strtotime($this->request->data['fecha_inicio']));
            $cupon->fecha_fin    = date("Y-m-d H:i:s", strtotime($this->request->data['fecha_fin']));
            $cupon->status = 1;
            $cupon->cliente_id = $this->UserAuth->getUserId();
            $cupon->categoria_id = 1;
            $cupon->marca_id = 1;
            $cupon->producto_id = 1;
            $cupon->cantidad = 1;
            $cupon->compra_minima = 0;
            $cupon->codigo = $this->request->data['nombre'].'-'.date("dmy");


            if ($this->Cupones->save($cupon)) {
                $this->Flash->success(__('The cupon has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cupon could not be saved. Please, try again.'));
            }
        }
        $clientes = $this->Cupones->Clientes->find('list', ['limit' => 200]);
        $categorias = $this->Cupones->Categorias->find('list', ['limit' => 200]);
        $marcas = $this->Cupones->Marcas->find('list', ['limit' => 200]);
        $productos = $this->Cupones->Productos->find('list', ['limit' => 200]);
        $this->set(compact('cupon', 'clientes', 'categorias', 'marcas', 'productos'));
        $this->set('_serialize', ['cupon']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Cupone id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cupone = $this->Cupones->get($id, [
            'contain' => []
        ]);

        $cupone['fecha_inicio'] = $cupone->fecha_inicio->i18nFormat('dd-MM-YYYY');
        $cupone['fecha_fin'] = $cupone->fecha_fin->i18nFormat('dd-MM-YYYY');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $cupone = $this->Cupones->patchEntity($cupone, $this->request->data);
            $cupon['fecha_inicio'] = date('Y-m-d', strtotime($this->request->data['fecha_inicio']));
            $cupon['fecha_fin'] = date('Y-m-d', strtotime($this->request->data['fecha_fin']));
            
            if ($this->Cupones->save($cupone)) {
                $this->Flash->success(__('The cupone has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The cupone could not be saved. Please, try again.'));
            }
        }
        $clientes = $this->Cupones->Clientes->find('list', ['limit' => 200]);
        $categorias = $this->Cupones->Categorias->find('list', ['limit' => 200]);
        $marcas = $this->Cupones->Marcas->find('list', ['limit' => 200]);
        $productos = $this->Cupones->Productos->find('list', ['limit' => 200]);
        $this->set(compact('cupone', 'clientes', 'categorias', 'marcas', 'productos'));
        $this->set('_serialize', ['cupone']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Cupone id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cupone = $this->Cupones->get($id);
        if ($this->Cupones->delete($cupone)) {
            $this->Flash->success(__('The cupone has been deleted.'));
        } else {
            $this->Flash->error(__('The cupone could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
