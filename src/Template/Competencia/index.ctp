<!-- File: /src/Template/Competencia/index.ctp -->
<p class="lead">
	<?= $this->Html->link('Competencias', ['controller' => 'competencia', 'action' => 'index'], ['class' => 'floatLeft color000 marginVertical20']) ?>
</p>
<script>
//	$(function () {
//		$('.view-more-orgs').click(function (e) {
//			e.preventDefault();
//			if ($(this).parent().next().is(':visible')) {
//				$(this).parent().next().slideUp();
//			} else {
//				$('.orgs').slideUp();
//				$(this).parent().next().slideDown();
//			}
//		})
//	})
</script>
<?
	echo $this->Html->link('Adicionar', ['controller' => 'competencia', 'action' => 'add'], ['class' => 'btn btn-success floatRight marginBottom10'])
	?>
	<table class="table table-condensed table-striped table-responsive">
		<tr>
			<th>Nome</th>
			<th></th>
		</tr>
		<tr>
		<?php echo $this->Form->create(null, array('type' => 'get')) ?>
		<td>
			<input type="text"
				   class='form-control'
				   name="Competencia.nome"
				   value="<?php echo (!empty($this->request->query['Competencia_nome']) ? $this->request->query['Competencia_nome'] : '' ) ?>" />
		</td>

		<td style="text-align: center;">
			<button type="submit" class="btn">
				<i class="glyphicon glyphicon-search"></i>
			</button>
		</td>
		<?php echo $this->Form->end() ?>
	</tr>
    <!-- Here is where we iterate through our $Competencias query object, printing out competencia info -->
	<?php
	$ultima_raiz = $espaco = '';
	foreach ($competencias as $competencia):
		?>
		<tr>
			<td>
				<?
				if ($ultima_raiz != $competencia->competencia_id) {
					//Novo galho da arvore encontrado
					if (empty($competencia->competencia_id)) {
						$espaco = '';
					} else if (empty($ultima_raiz) && !empty($competencia->competencia_id)) {
						$espaco = '&nbsp;&nbsp;&nbsp;&nbsp;';
					} else {
						$espaco.='&nbsp;&nbsp;&nbsp;&nbsp;';
					}
					$ultima_raiz = $competencia->competencia_id;
				}
				?>
				<?= $espaco . '<span class="glyphicon glyphicon-triangle-right"></span>' . $competencia->nome ?>
			</td>
			<td>
				<div class="floatRight">
					<?= $this->Html->link('Editar', ['action' => 'edit', $competencia->id], ['class' => 'btn btn-primary']) ?>
					&nbsp;
					<?
					echo $this->Form->postLink('Excluir', ['action' => 'delete', $competencia->id], ['confirm' => 'Você tem certeza?', 'class' => 'btn btn-danger'])
						?>
				</div>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
