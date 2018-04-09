<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductoOrientaciones Model
 *
 * @method \App\Model\Entity\ProductoOrientacione get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProductoOrientacione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProductoOrientacione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProductoOrientacione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProductoOrientacione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProductoOrientacione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProductoOrientacione findOrCreate($search, callable $callback = null)
 */
class ProductoOrientacionesTable extends Table
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

        $this->table('producto_orientaciones');
        $this->displayField('nombre');
        $this->primaryKey('id');
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

        return $validator;
    }
}
