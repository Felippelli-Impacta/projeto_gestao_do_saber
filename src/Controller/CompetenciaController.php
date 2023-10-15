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
class CompetenciaController extends AppController {

	public $filter_with_like=array(
		'Competencia.nome'
		);

	public function index() {
		parent::gerarFiltros();

		$this->conditions['Competencia.habilitado']=1;
		$competencias = $this->Competencia->find()
				->where($this->conditions)
				->order('lft')->all();

		$this->set(compact('competencias'));
	}

	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Competencia Inválida'));
		}
		$competencia = $this->Competencia->get($id);
		$this->set(compact('competencia'));
	}

	public function add() {
		//monta a lista referente a arvore
		$parents = $this->Competencia->find('treeList',['spacer'=>'_'])->where(['Competencia.habilitado'=>1]);

		$competencia = $this->Competencia->newEntity($this->request->data);
		if ($this->request->is('post')) {
			if ($this->Competencia->save($competencia )) {
				$this->Flash->success(__('Competencia criada.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Não foi possivel adicionar a competencia.'));
		}
		$this->set(compact('competencia', 'parents'));
	}

	public function edit($id = null) {
		//monta a lista referente a arvore
		$parents = $this->Competencia->find('treeList',['spacer'=>'_'])->where(['Competencia.habilitado'=>1]);

		if (!$id) {
			throw new NotFoundException(__('Invalid competencia'));
		}

		$competencia = $this->Competencia->find()
				->where(['Competencia.id' => $id])
				->first();
		if ($this->request->is(['post', 'put'])) {
			$this->Competencia->patchEntity($competencia, $this->request->data );
			if ($this->Competencia->save($competencia )) {
				$this->Flash->success(__('Competencia atualizada.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to update your competencia.'));
		}

		$this->set(compact('competencia', 'parents'));
	}

	public function delete($id) {
		$this->request->allowMethod(['post', 'delete']);

		$competencia = $this->Competencia->get($id);
//		$competencia->id = $id;
//		$competencia->habilitado = 0;

		if ($this->Competencia->delete($competencia)) {
			$this->Flash->success("Competencia #{$id} foi deletada.");
			return $this->redirect(['action' => 'index']);
		}
	}

}
