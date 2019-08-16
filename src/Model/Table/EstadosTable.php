<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Estado Model
 *
 * @method \App\Model\Entity\Estado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Estado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Estado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Estado|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Estado saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Estado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Estado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Estado findOrCreate($search, callable $callback = null, $options = [])
 */
class EstadosTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('estado');
        $this->setDisplayField('nom_estado');
        $this->setPrimaryKey('id_estado');

        $this->hasMany('Cidades', [
            'foreignKey' => 'id_estado'
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
            ->integer('id_estado')
            ->allowEmptyString('id_estado', null, 'create');

        $validator
            ->scalar('nom_estado')
            ->requirePresence('nom_estado', 'create')
            ->notEmptyString('nom_estado');

        $validator
            ->scalar('sgl_estado')
            ->maxLength('sgl_estado', 2)
            ->requirePresence('sgl_estado', 'create')
            ->notEmptyString('sgl_estado');

        $validator
            ->integer('id_pais')
            ->allowEmptyString('id_pais');

        return $validator;
    }
}
