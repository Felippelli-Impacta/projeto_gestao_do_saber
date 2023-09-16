<!-- File: /src/Template/Articles/add.ctp -->
<?php echo $this->Html->script(['profissional/add']); ?>
<p class="lead color000 marginTop20 floatLeft ten-column">
	<?= $this->Html->link('Profissionais', [ 'action' => 'index']) ?>
	:: Adicionar
    <br>
	<?= $this->Html->link('Voltar', ['controller' => 'profissional', 'action' => 'index'], ['class' => 'btn btn-info marginTop10']) ?>
</p>

<div class="users form col-lg-6">
	<?php
	echo $this->Form->create($profissional,[ 'onsubmit' => 'return check_form()']);
	echo $this->Form->input('coordenador_id', [
		'class' => 'form-control',
		'label' => 'Coordenador:',
		'options' => $profissionais,
		'empty' => '[ Coordenador ]'
	]);
	echo $this->Form->input('nome', ['class' => 'form-control', 'label' => 'Nome:']);
	echo $this->Form->input('email', [
		'class' => 'form-control',
		'label' => 'Email:',
		'type' => 'email'
	]);
	echo $this->Form->input('cpf', ['class' => 'form-control', 'label' => 'CPF:']);
	echo $this->Form->input('rg', ['class' => 'form-control', 'label' => 'RG:']);
	?>
    <br>
	<?php
	echo $this->Form->button(__('Salvar'), ['class' => 'btn btn-large btn-success form-control', 'id' => 'btn-submit']);
	echo $this->Form->end();
	?>
</div>
