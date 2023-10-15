<!-- File: /src/Template/Competencia/edit.ctp -->
<p class="lead color000 marginTop20 floatLeft ten-column">
    <?= $this->Html->link('Competencias', ['controller' => 'competencia', 'action' => 'index'], ['class' => 'floatLeft color000 ']) ?>

	&nbsp;> Editar
    <br>
    <?= $this->Html->link('Voltar', ['controller' => 'competencia', 'action' => 'index'], ['class' => 'btn btn-info marginTop10']) ?>
</p>

<div class="form col-lg-6">
<?php
    echo $this->Form->create($competencia);
    echo $this->Form->input('competencia_id', [
		'class' => 'form-control',
		'options' => $parents,
		'empty'=>'[ Competencia ]',
		'label'=>'Aninhar competencia em:'
		]);
    echo $this->Form->input('nome', ['class' => 'form-control']);
    echo '<br>';

	?>
	<br>
	<?php
    echo $this->Form->button(__('Salvar'),['class'=>'btn btn-success btn-block']);
    echo $this->Form->end();
?>
</div>
