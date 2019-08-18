<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pessoas Controller
 *
 * @property \App\Model\Table\PessoasTable $Pessoas
 *
 * @method \App\Model\Entity\Pessoa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PessoasController extends AppController
{
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pessoa = $this->Pessoas->newEntity();
        if ($this->request->is('post')) {
            $pessoa = $this->Pessoas->patchEntity($pessoa, $this->request->getData());
            if ($this->Pessoas->save($pessoa)) {
                $this->Flash->success(__('Dados salvos com sucesso.'));
            } else {
                $this->Flash->error(__('Não foi possível salvar os dados. Tente novamente.'));
            }
        }

        $this->paginate = [
            'contain' => ['Cidades' => 'Estados']
        ];
        $pessoas = $this->paginate($this->Pessoas);

        $this->set(compact('pessoa', 'pessoas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pessoa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pessoa = $this->Pessoas->get($id);
        if ($this->Pessoas->delete($pessoa)) {
            $this->Flash->success(__('Dados excluídos com sucesso..'));
        } else {
            $this->Flash->error(__('Não foi possível excluir os dados. Tente novamente'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
