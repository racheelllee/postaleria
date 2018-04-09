<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProductoTipoFotos Controller
 *
 * @property \App\Model\Table\ProductoTipoFotosTable $ProductoTipoFotos
 */
class ProductoTipoFotosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $productoTipoFoto = $this->ProductoTipoFotos->newEntity();
        $productoTipoFotos = $this->paginate($this->ProductoTipoFotos);
        $dependencies = ['productoTipoFoto', ];
        $this->set(compact('productoTipoFoto', 'productoTipoFotos', ));
        $this->set('_serialize', ['productoTipoFotos']);
    }

    /**
     * View method
     *
     * @param string|null $id Producto Tipo Foto id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productoTipoFoto = $this->ProductoTipoFotos->get($id, [
            'contain' => ['Productos']
        ]);

        $this->set('productoTipoFoto', $productoTipoFoto);
        $this->set('_serialize', ['productoTipoFoto']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productoTipoFoto = $this->ProductoTipoFotos->newEntity();
        if ($this->request->is('post')) {
            $productoTipoFoto = $this->ProductoTipoFotos->patchEntity($productoTipoFoto, $this->request->data);
            if ($this->ProductoTipoFotos->save($productoTipoFoto)) {
                $this->Flash->success(__('The producto tipo foto has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The producto tipo foto could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('productoTipoFoto'));
        $this->set('_serialize', ['productoTipoFoto']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Producto Tipo Foto id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productoTipoFoto = $this->ProductoTipoFotos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productoTipoFoto = $this->ProductoTipoFotos->patchEntity($productoTipoFoto, $this->request->data);
            if ($this->ProductoTipoFotos->save($productoTipoFoto)) {
                $this->Flash->success(__('The producto tipo foto has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The producto tipo foto could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('productoTipoFoto'));
        $this->set('_serialize', ['productoTipoFoto']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Producto Tipo Foto id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productoTipoFoto = $this->ProductoTipoFotos->get($id);
        if ($this->ProductoTipoFotos->delete($productoTipoFoto)) {
            $this->Flash->success(__('The producto tipo foto has been deleted.'));
        } else {
            $this->Flash->error(__('The producto tipo foto could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
