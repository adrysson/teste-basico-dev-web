<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cidade Entity
 *
 * @property int $id_cidade
 * @property string $nom_cidade
 * @property int $id_estado
 *
 * @property \App\Model\Entity\Pessoa[] $pessoas
 */
class Cidade extends Entity
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
        'nom_cidade' => true,
        'id_estado' => true,
        'pessoas' => true
    ];

    protected function _getNomCidade(string $nome)
    {
        return utf8_decode($nome);
    }
}
