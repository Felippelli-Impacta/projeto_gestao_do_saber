<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProfissionalTable extends Table {



	public function initialize(array $config) {
		$this->table('profissional');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Coordenador', [
			'className'=>'Profissional',
                        'foreignKey' => 'coordenador_id'
                        ]);
		$this->hasMany('Coordenado', [
			'className'=>'Profissional',
                        'foreignKey' => 'coordenador_id'
                    ]);
		$this->displayField('nome');
	}

	public function validationDefault(Validator $validator) {
		$validator
				->notEmpty('nome')
				->notEmpty('email');

		return $validator;
	}

}
