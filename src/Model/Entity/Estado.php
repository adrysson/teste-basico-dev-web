<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Estado Entity
 *
 * @property int $id_estado
 * @property string $nom_estado
 * @property string $sgl_estado
 * @property int|null $id_pais
 */
class Estado extends Entity
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
        'nom_estado' => true,
        'sgl_estado' => true,
        'id_pais' => true
    ];

    protected function _getNomEstado(string $nome)
    {
        return utf8_decode($nome);
    }

    protected function _getSglEstado(string $uf)
    {
        return substr($uf, 0, 2);
    }
}
