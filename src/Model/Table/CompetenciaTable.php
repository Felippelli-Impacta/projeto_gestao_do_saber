<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Model\Behavior\TreeBehavior;

class CompetenciaTable extends Table {

	public function initialize(array $config) {
		$this->addBehavior('Tree',[
			'parent' => 'competencia_id',
			'left' => 'lft',
			'right' => 'rght',
			//'level' => 'level'
			]);
		$this->displayField('nome');
    }

	public function validationDefault(Validator $validator) {
		$validator
				->notEmpty('nome');

		return $validator;
	}

}
