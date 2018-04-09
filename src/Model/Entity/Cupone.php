<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cupone Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string $codigo
 * @property bool $cupon_unico
 * @property int $cliente_id
 * @property float $monto
 * @property int $porcentaje
 * @property \Cake\I18n\Time $fecha_inicio
 * @property \Cake\I18n\Time $fecha_fin
 * @property int $categoria_id
 * @property int $marca_id
 * @property int $producto_id
 * @property int $cantidad
 * @property float $compra_minima
 * @property string $descripcion
 *
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Categoria $categoria
 * @property \App\Model\Entity\Marca $marca
 * @property \App\Model\Entity\Producto $producto
 */
class Cupone extends Entity
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
        '*' => true,
        'id' => false
    ];
}
