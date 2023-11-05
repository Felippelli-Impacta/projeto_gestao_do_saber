<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SaberTable extends Table {

	public function initialize(array $config) {
		$this->belongsTo('Profissional');
		$this->belongsTo('Competencia');

	}

	public function validationDefault(Validator $validator) {
		$validator
				->notEmpty('nivel');

		return $validator;
	}

}
