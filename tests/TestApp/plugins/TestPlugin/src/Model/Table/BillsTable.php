<?php
declare(strict_types=1);

namespace TestPlugin\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bills Model
 *
 * @property \TestPlugin\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 * @property \TestPlugin\Model\Table\ArticlesTable&\Cake\ORM\Association\BelongsTo $Articles
 *
 * @method \TestPlugin\Model\Entity\Bill newEmptyEntity()
 * @method \TestPlugin\Model\Entity\Bill newEntity(array $data, array $options = [])
 * @method \TestPlugin\Model\Entity\Bill[] newEntities(array $data, array $options = [])
 * @method \TestPlugin\Model\Entity\Bill get($primaryKey, $options = [])
 * @method \TestPlugin\Model\Entity\Bill findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \TestPlugin\Model\Entity\Bill patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \TestPlugin\Model\Entity\Bill[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \TestPlugin\Model\Entity\Bill|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TestPlugin\Model\Entity\Bill saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \TestPlugin\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \TestPlugin\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \TestPlugin\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \TestPlugin\Model\Entity\Bill[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BillsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('bills');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
            'className' => 'TestPlugin.Customers',
        ]);
        $this->belongsTo('Articles', [
            'foreignKey' => 'article_id',
            'joinType' => 'INNER',
            'className' => 'Articles',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->numeric('amount')
            ->requirePresence('amount', 'create')
            ->notEmptyString('amount');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['customer_id'], 'Customers'), ['errorField' => 'customer_id']);
        $rules->add($rules->existsIn(['article_id'], 'Articles'), ['errorField' => 'article_id']);

        return $rules;
    }
}
