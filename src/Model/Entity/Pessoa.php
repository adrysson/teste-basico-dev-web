<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Pessoa Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $celular
 * @property int $cidade_id
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Cidade $cidade
 */
class Pessoa extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'nome' => true,
        'email' => true,
        'celular' => true,
        'cidade_id' => true,
        'created' => true,
        'cidade' => true
    ];
}
