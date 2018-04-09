<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProductoOrientaciones Controller
 *
 * @property \App\Model\Table\ProductoOrientacionesTable $ProductoOrientaciones
 */
class ProductoOrientacionesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $productoOrientacione = $this->ProductoOrientaciones->newEntity();
        $this->paginate = [
            'contain' => ['Productos']
        ];
        $productoOrientaciones = $this->paginate($this->ProductoOrientaciones);
        $productos = $this->ProductoOrientaciones->Productos->find('list', ['limit' => 200]);
        $dependencies = ['productoOrientacione', 'productos'];
        $this->set(compact('productoOrientacione', 'productoOrientaciones', 'productos'));
        $this->set('_serialize', ['productoOrientaciones']);
    }

    /**
     * View method
     *
     * @param string|null $id Producto Orientacione id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productoOrientacione = $this->ProductoOrientaciones->get($id, [
            'contain' => ['Productos']
        ]);

        $this->set('productoOrientacione', $productoOrientacione);
        $this->set('_serialize', ['productoOrientacione']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productoOrientacione = $this->ProductoOrientaciones->newEntity();
        if ($this->request->is('post')) {
            $productoOrientacione = $this->ProductoOrientaciones->patchEntity($productoOrientacione, $this->request->data);
            if ($this->ProductoOrientaciones->save($productoOrientacione)) {
                $this->Flash->success(__('The producto orientacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The producto orientacione could not be saved. Please, try again.'));
            }
        }
        $productos = $this->ProductoOrientaciones->Productos->find('list', ['limit' => 200]);
        $this->set(compact('productoOrientacione', 'productos'));
        $this->set('_serialize', ['productoOrientacione']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Producto Orientacione id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productoOrientacione = $this->ProductoOrientaciones->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productoOrientacione = $this->ProductoOrientaciones->patchEntity($productoOrientacione, $this->request->data);
            if ($this->ProductoOrientaciones->save($productoOrientacione)) {
                $this->Flash->success(__('The producto orientacione has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The producto orientacione could not be saved. Please, try again.'));
            }
        }
        $productos = $this->ProductoOrientaciones->Productos->find('list', ['limit' => 200]);
        $this->set(compact('productoOrientacione', 'productos'));
        $this->set('_serialize', ['productoOrientacione']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Producto Orientacione id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productoOrientacione = $this->ProductoOrientaciones->get($id);
        if ($this->ProductoOrientaciones->delete($productoOrientacione)) {
            $this->Flash->success(__('The producto orientacione has been deleted.'));
        } else {
            $this->Flash->error(__('The producto orientacione could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
