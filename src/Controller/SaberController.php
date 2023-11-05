<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Utility\Inflector;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\NotFoundException;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class SaberController extends AppController {
	public $uses = array('Competencia');

	public function isAuthorized($user) {
        return true;
	}

	public function index($profissional_id=null) {
		$this->loadModel('Competencia');
		$this->conditions['Competencia.habilitado']=1;

		$profissional = $this->Saber->Profissional->find()->contain(['Coordenador','Coordenado'])
				->where(['Profissional.id' => $profissional_id])
				->first();

		//pr($profissional);
		$sabers = $this->Saber->find()
				->where(['Saber.profissional_id' => $profissional_id])
				->all();
		$competencias = $this->Competencia->find('TreeList',['spacer'=>'&'])
				->where($this->conditions)
				->toArray();

		$competencias2 = $this->Competencia->find()
				->order('Competencia.lft')
				->all()
				->toArray();
		foreach($competencias as $i=>&$a){
			foreach($competencias2 as $i2=>$competencia2)
			if($i == $competencia2->id){
				$competencia2->nome = $a;
				$a=$competencia2;
				break;
			}
			unset($competencias2[$i2]);
		}

		#pr($competencias);
		//pr($competencias2);
		#exit();
		$c=0;

		#$competencias_folhas = $this->Competencia->find();
		#$expr = $competencias_folhas->newExpr()->add('Competencia.rght=Competencia.lft+1');
		#$competencias_folhas=$competencias_folhas->where([$expr])->order(['Competencia.lft'])->all();

		$this->set(compact('competencias','profissional','sabers'));
	}

	public function save() {
		$this->autoRender=false;
		$retorno = array('error'=>true);
		if($this->request->is('post')) {
			$saber = $this->Saber->newEntity($this->request->data);
			if ($this->Saber->save($saber)) {
				$retorno['error']=false;
				$retorno['saber']=$saber;
			}

		}
		echo json_encode($retorno);
	}

}
