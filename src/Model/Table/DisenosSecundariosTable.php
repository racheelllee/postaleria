<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DisenosSecundarios Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Productos
 *
 * @method \App\Model\Entity\DisenosSecundario get($primaryKey, $options = [])
 * @method \App\Model\Entity\DisenosSecundario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DisenosSecundario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DisenosSecundario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DisenosSecundario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DisenosSecundario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DisenosSecundario findOrCreate($search, callable $callback = null)
 */
class DisenosSecundariosTable extends Table
{
     protected function _initializeSchema(\Cake\Database\Schema\Table $table)
    {
        $table->columnType('image', 'proffer.file');
        return $table;
    }

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('disenos_secundarios');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Productos', [
            'foreignKey' => 'producto_id',
            'joinType' => 'INNER'
        ]);
        $this->addBehavior('Proffer.Proffer', [
            'image' => [
                'dir' => 'image_dir',
                'thumbnailSizes' => [
                    'square' => ['w' => 100, 'h' => 100],
                    'large' => ['w' => 250, 'h' => 250]
                ]
            ]
        ]);

        $this->belongsTo('Producto', ['foreignKey' => 'producto_id', 'joinType' => 'INNER']);
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
            ->requirePresence('diseno_secundario', 'create')
            ->notEmpty('diseno_secundario');

        $validator
            ->requirePresence('image', 'create')
            ->allowEmpty('image', 'update');

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
        $rules->add($rules->existsIn(['producto_id'], 'Productos'));

        return $rules;
    }
}
