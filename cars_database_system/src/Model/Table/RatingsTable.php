<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ratings Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\CarsTable&\Cake\ORM\Association\BelongsTo $Cars
 *
 * @method \App\Model\Entity\Rating newEmptyEntity()
 * @method \App\Model\Entity\Rating newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Rating[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rating get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rating findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Rating patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rating[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rating|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rating saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rating[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rating[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rating[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Rating[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RatingsTable extends Table
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

        $this->setTable('ratings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->belongsTo('Cars', [
            'foreignKey' => 'car_id',
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
        // $validator
        //     ->integer('user_id')
        //     ->allowEmptyString('user_id');

        // $validator
        //     ->integer('car_id')
        //     ->allowEmptyString('car_id');

        $validator
            ->scalar('rating')
            ->maxLength('rating', 255)
            ->requirePresence('rating', 'create')
            ->notEmptyString('rating');

        $validator
            ->scalar('review')
            ->maxLength('review', 255)
            ->requirePresence('review', 'create')
            ->notEmptyString('review');

        // $validator
        //     ->scalar('status')
        //     ->maxLength('status', 255)
        //     ->notEmptyString('status');

        // $validator
        //     ->dateTime('created_at')
        //     ->requirePresence('created_at', 'create')
        //     ->notEmptyDateTime('created_at');

        // $validator
        //     ->dateTime('modified_at')
        //     ->requirePresence('modified_at', 'create')
        //     ->notEmptyDateTime('modified_at');

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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('car_id', 'Cars'), ['errorField' => 'car_id']);

        return $rules;
    }
}
