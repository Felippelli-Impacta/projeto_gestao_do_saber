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
class ProfissionalController extends AppController {

	public function index() {

		$query = $this->Profissional->find('all')->where(['habilitado' => 1]);

		$profissionals = $query->contain(['Coordenado']);
		$this->set(compact('profissionals'));
	}

	public function view($id = null) {
		if (!$id) {
			throw new UnauthorizedException(__('Profisisonal inválido'));
		}
		$profissional = $this->Profissional->get($id);
		$contato = $this->Profissional->Contato->find()->where(['profissional_id' => $id])->first();

		$this->set(compact('profissional', 'contato'));
	}

	public function add() {
		$profissional = $this->Profissional->newEntity($this->request->data);
		if ($this->request->is('post')) {
            $this->request->data['User']['role'] = 'profissional';
            if ($this->Profissional->save($profissional)) {
                $this->Flash->success(__('Dados do profissional salvos com sucesso.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Erro ao salvar dados do profissional.'));
            }
        }
		$profissionais = $this->Profissional->find('list');

		$this->set(compact('profissional', 'profissionais'));
	}

	public function edit($id = null) {
		if (!$id) {
			throw new UnauthorizedException(__('Profissional não encontrado'));
		}

		$profissional = $this->Profissional->find('all')
				->where(['Profissional.id' => $id])
				->first();

		if ($this->request->is(['post', 'put'])) {
			$this->Profissional->patchEntity($profissional, $this->request->data);
			if ($this->Profissional->save($profissional)) {
                $this->Flash->success(__('Profissional atualizado.'));
                return $this->redirect(['action' => 'index']);
            } else {
				$this->Flash->error(__('Não foi possivel atualizar.'));
			}
		}

		$profissionais = $this->Profissional->find('list');

		$this->set(compact('profissional', 'profissionais'));
	}

	public function delete($id) {
		$this->request->allowMethod(['post', 'delete']);

		$profissional = $this->Profissional->get($id);
		$profissional->id = $id;
		$profissional->habilitado = 0;

		if ($this->Profissional->save($profissional)) {
			$this->Flash->success(__('O profissional com ID: '.$id.' foi deletado.'));
			return $this->redirect(['action' => 'index']);
		} else {
			$this->Flash->success(__('Erro ao deletar usuário.'));
		}
	}

}
