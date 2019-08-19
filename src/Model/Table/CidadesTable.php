<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cidade Model
 *
 * @property \App\Model\Table\PessoasTable&\Cake\ORM\Association\HasMany $Pessoas
 *
 * @method \App\Model\Entity\Cidade get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cidade newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cidade[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cidade|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cidade saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cidade patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cidade[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cidade findOrCreate($search, callable $callback = null, $options = [])
 */
class CidadesTable extends Table
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

        $this->setTable('cidade');
        $this->setDisplayField('nom_cidade');
        $this->setPrimaryKey('id_cidade');

        $this->hasMany('Pessoas', [
            'foreignKey' => 'cidade_id'
        ]);
        $this->belongsTo('Estados', [
            'foreignKey' => 'id_estado',
            'joinType' => 'INNER'
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
            ->integer('id_cidade')
            ->allowEmptyString('id_cidade', null, 'create');

        $validator
            ->scalar('nom_cidade')
            ->requirePresence('nom_cidade', 'create')
            ->notEmptyString('nom_cidade');

        $validator
            ->integer('id_estado')
            ->requirePresence('id_estado', 'create')
            ->notEmptyString('id_estado');

        return $validator;
    }
}
