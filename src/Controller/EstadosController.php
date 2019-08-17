<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Estados Controller
 *
 * @property \App\Model\Table\EstadosTable $Estados
 *
 * @method \App\Model\Entity\Estado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EstadosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $estados = $this->paginate($this->Estados);

        $this->set([
            'estados' => $estados,
            '_serialize' => ['estados'],
        ]);
    }
}
