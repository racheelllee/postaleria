<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductoTipoFotos Model
 *
 * @property \Cake\ORM\Association\HasMany $Productos
 * @property \Cake\ORM\Association\HasMany $Productos
 *
 * @method \App\Model\Entity\ProductoTipoFoto get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductoTipoFoto newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProductoTipoFoto[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductoTipoFoto|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductoTipoFoto patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductoTipoFoto[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductoTipoFoto findOrCreate($search, callable $callback = null)
 */
class ProductoTipoFotosTable extends Table
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

        $this->table('producto_tipo_fotos');
        $this->displayField('nombre');
        $this->primaryKey('id');

        $this->hasMany('Productos', [
            'foreignKey' => 'producto_tipo_foto_id'
        ]);
        $this->hasMany('Productos', [
            'foreignKey' => 'producto_tipo_foto_id'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        $validator
            ->requirePresence('nombre_real', 'create')
            ->notEmpty('nombre_real');

        $validator
            ->requirePresence('size', 'create')
            ->notEmpty('size');

        return $validator;
    }
}
