<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pessoas Model
 *
 * @property \App\Model\Table\CidadeTable&\Cake\ORM\Association\BelongsTo $Cidade
 *
 * @method \App\Model\Entity\Pessoa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pessoa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pessoa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pessoa|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pessoa saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pessoa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pessoa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pessoa findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PessoasTable extends Table
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

        $this->setTable('pessoas');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Cidades', [
            'foreignKey' => 'cidade_id',
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
            ->integer('id', 'O código deve ser do tipo inteiro')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nome', 'O campo Nome Completo foi preenchido com o tipo de dado errado')
            ->maxLength('nome', 255, 'O campo Nome Completo deve ser preenchido com no máximo 255 caracteres')
            ->requirePresence('nome', 'create', 'O Nome Completo deve estar presente no formulário')
            ->notEmptyString('nome', 'O campo Nome Completo é obrigatório')
            ->add('nome', 'isComplete', [
                'rule' => function (?string $data) {
                    $words = explode(' ', $data);
                    if (count($words) < 2) {
                        return 'Informe seu nome completo';
                    }
                    return true;
                },
            ]);

        $validator
            ->email('email', 'O campo E-mail deve ser preenchido com um e-mail válido')
            ->requirePresence('email', 'create', 'O E-mail deve estar presente no formulário')
            ->notEmptyString('email', 'O campo E-mail é obrigatório')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Já existe uma pessoa cadastrada com esse E-mail']);

        $validator
            ->scalar('celular', 'O campo Celular foi enviado com o tipo de dado errado')
            ->maxLength('celular', 17, 'O campo Celular deve ser preenchido com 16 caracteres')
            ->minLength('celular', 15, 'O campo Celular deve ser preenchido com 16 caracteres')
            ->requirePresence('celular', 'create', 'O Celular deve estar presente no formulário')
            ->notEmptyString('celular', 'O campo Celular é obrigatório')
            ->add('celular', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'Já existe uma pessoa cadastrada com esse Celular']);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email'], 'Já existe uma pessoa cadastrada com esse E-mail'));
        $rules->add($rules->isUnique(['celular'], 'Já existe uma pessoa cadastrada com esse E-mail'));
        $rules->add($rules->existsIn(['cidade_id'], 'Cidades', 'O campo Cidade é obrigatório e deve existir na nossa base de dados de cidades'));

        return $rules;
    }
}
