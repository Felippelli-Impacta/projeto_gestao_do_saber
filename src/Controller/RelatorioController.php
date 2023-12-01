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
class RelatorioController extends AppController {
	public $filter_with_like=array(
		'Profissional.nome',
		'Competencia.nome'
		);

	public function isAuthorized($user) {
		return parent::isAuthorized($user);
	}

	public function index() {
		$this->loadModel('Saber');
		$this->loadModel('Competencia');

		parent::gerarFiltros();

		$this->conditions['Competencia.habilitado']=1;

		//pr($profissional);
		$conhe = $this->conditions;
		$rcompetencia=array();
		foreach($conhe as $coluna =>$value):
			if(substr_count($coluna, 'Competencia')==1){
				$rcompetencia[$coluna]=$value;
			}
		endforeach;
		foreach($rcompetencia as $rrr=>$rv):
			unset($conhe[$rrr]);
		endforeach;
		$sabers = $this->Saber->find()
				->select($this->Saber)
				->select($this->Saber->Competencia)
				->select($this->Saber->Profissional)
				->contain(['Profissional'])
				->autoFields(true)
				->where($conhe)
				->join([
					'Competencia'=>[
						'table'=>'competencia',
						'type'=>'INNER',
						'conditions'=>'Competencia.id=Saber.competencia_id'
					]
				])
				->order('Profissional.id,Competencia.rght')
				->all();


		foreach($this->conditions as $coluna =>$value):
			if(substr_count($coluna, 'Competencia.nome')==1
				|| (substr_count($coluna, 'Competencia')==0) ){
				$conditions_org[$coluna]=$value;
				$r[$coluna]=$value;
			}
		endforeach;
		if(!empty($r))
		foreach($r as $rr=>$rv):
			unset($this->conditions[$rr]);
		endforeach;

		$joins_competencia=[];
		if(!empty($rcompetencia)){

			$rcompetencia2['OR']=array(  array_merge([
				 'Competencia.id = Competencia2.id '
					],$rcompetencia)
					);

			foreach($rcompetencia as $coluna=>$value):
				if(substr_count($coluna, 'Competencia.nome')==1){
					$rcompetencia2['OR'][1][]=str_ireplace('Competencia.nome','Competencia2.nome',$coluna)." '$value'";
				}
			endforeach;
			$rcompetencia2['OR'][1][]='Competencia.id != Competencia2.id';
			$rcompetencia2['OR'][1][]='Competencia.lft > Competencia2.lft';
			$rcompetencia2['OR'][1][]='Competencia.rght < Competencia2.rght';
			$rcompetencia=$rcompetencia2;
			#pr($rcompetencia);exit();
			$this->conditions = array_merge($this->conditions,$rcompetencia);
			$joins_competencia=[
				[
					'table'=>'competencia Competencia2',
					'type'=>'',
					'conditions'=>array()
				]
			];
		}

		$competencias = $this->Competencia->find('TreeList',[
			'spacer'=>'&',
			'order'=>['Competencia.lft ASC']
			])
				->where($this->conditions)
                ->join($joins_competencia)
				->toArray();

//		pr($rcompetencia);exit();
		$competencias2 = $this->Competencia->find()
				->join($joins_competencia)
				->where($rcompetencia)
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


		$c=0;


		$this->set(compact('competencias','sabers'));
	}



}
