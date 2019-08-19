<?php
namespace App\Controller\Estados;

use App\Controller\AppController;

/**
 * Cidades Controller
 *
 * @property \App\Model\Table\CidadesTable $Cidades
 *
 * @method \App\Model\Entity\Cidade[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CidadesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'conditions' => ['id_estado' => $this->request->getParam('estado_id')],
        ];
        $cidades = $this->paginate($this->Cidades);

        $this->set([
            'cidades' => $cidades,
            '_serialize' => ['cidades'],
        ]);
    }
}
