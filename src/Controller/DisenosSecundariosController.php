<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DisenosSecundarios Controller
 *
 * @property \App\Model\Table\DisenosSecundariosTable $DisenosSecundarios
 */
class DisenosSecundariosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $disenosSecundario = $this->DisenosSecundarios->newEntity();
        $this->paginate = [
            'contain' => ['Productos']
        ];
        $disenosSecundarios = $this->paginate($this->DisenosSecundarios);
        $productos = $this->DisenosSecundarios->Productos->find('list', ['limit' => 200]);
        $dependencies = ['disenosSecundario', 'productos'];
        $this->set(compact('disenosSecundario', 'disenosSecundarios', 'productos'));
        $this->set('_serialize', ['disenosSecundarios']);
    }

    /**
     * View method
     *
     * @param string|null $id Disenos Secundario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $disenosSecundario = $this->DisenosSecundarios->get($id, [
            'contain' => ['Productos']
        ]);

        $this->set('disenosSecundario', $disenosSecundario);
        $this->set('_serialize', ['disenosSecundario']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $disenosSecundario = $this->DisenosSecundarios->newEntity();
        if ($this->request->is('post')) {
            $disenosSecundario = $this->DisenosSecundarios->patchEntity($disenosSecundario, $this->request->data);
            if ($this->DisenosSecundarios->save($disenosSecundario)) {
                $this->Flash->success(__('The disenos secundario has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The disenos secundario could not be saved. Please, try again.'));
            }
        }
        $productos = $this->DisenosSecundarios->Productos->find('list', ['limit' => 200]);
        $this->set(compact('disenosSecundario', 'productos'));
        $this->set('_serialize', ['disenosSecundario']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Disenos Secundario id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $disenosSecundario = $this->DisenosSecundarios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $disenosSecundario = $this->DisenosSecundarios->patchEntity($disenosSecundario, $this->request->data);
            if ($this->DisenosSecundarios->save($disenosSecundario)) {
                $this->Flash->success(__('The disenos secundario has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The disenos secundario could not be saved. Please, try again.'));
            }
        }
        $productos = $this->DisenosSecundarios->Productos->find('list', ['limit' => 200]);
        $this->set(compact('disenosSecundario', 'productos'));
        $this->set('_serialize', ['disenosSecundario']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Disenos Secundario id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $disenosSecundario = $this->DisenosSecundarios->get($id);
        if ($this->DisenosSecundarios->delete($disenosSecundario)) {
            $this->Flash->success(__('The disenos secundario has been deleted.'));
        } else {
            $this->Flash->error(__('The disenos secundario could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
