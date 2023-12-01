<!-- File: /src/Template/Saber/index.ctp -->
<?= $this->Html->css('jquery-ui') ?>
<?= $this->Html->script(array('jquery-ui', 'saber/index')) ?>

<p class="lead ten-column floatLeft color000 marginVertical20">
	<?= $this->Html->link('Relatório', [ 'action' => 'index'], ['class' => 'floatLeft color000']) ?>
</p>
<!-- Here is where we iterate through our $competencias query object, printing out competencia info -->
<div class="row" style="border-bottom: 1px #ddd solid;padding: 5px 10px; ">
	<?php echo $this->Form->create(null, array('type' => 'get')) ?>
	<div class="col-md-2">
		<input type="text" style="width: 150px"
			   class='form-control'
			   placeholder='PROFISSIONAL'
			   title='PROFISSIONAL'
			   name="Profissional.nome"
			   value="<?php echo (!empty($this->request->query['Profissional_nome']) ? $this->request->query['Profissional_nome'] : '' ) ?>" />
	</div>
	<div class="col-md-9">
		<input type="text" style="width:350px"
			   class='form-control'
			   placeholder='Competencia'
			   title='Competencia'
			   name="Competencia.nome"
			   value="<?php echo (!empty($this->request->query['Competencia_nome']) ? $this->request->query['Competencia_nome'] : '' ) ?>" />
	</div>
	<div class="col-md-1">
		<button type="submit" class="btn">
			<i class="glyphicon glyphicon-search"></i>
		</button>
	</div>
	<?php echo $this->Form->end() ?>
</div>
<div class="row" style="max-height: 600px;overflow-y: scroll;overflow-x: hidden ">
	<?php
	$array_best = array();
	$total_profissionais=0;
#echo $this->Form->create('Saber',['url'=>['action'=>'edit',$profissional->id]]);
	$c = 0;
	$profissionais = array();
	$prof_impressos = array();
	foreach ($sabers as $cot):
		$profissionais[$cot->profissional['id']][] = [
			'competencia_id' => $cot->competencia_id,
			'nivel' => $cot->nivel,
		];
	endforeach;
	foreach ($sabers as $co) {
		if (in_array($co->profissional['id'], $prof_impressos))
			continue;

		$total_profissionais++;
		?>
		<div class="row" style="border-bottom: 1px #ddd solid;padding: 5px 10px;">
			<div class="col-md-2">
				<?= $co->profissional['nome']; ?>
			</div>
			<div class="col-md-8">
				<table class="table table-striped table-responsive table-bordered table-condensed table-hover">
					<?php
					foreach ($competencias as $id => $competencia) {
						?>

						<tr>
							<?php
							$leaf = FALSE;
							//Verifica se o registro é um ponta da arvore
							if ($competencia->rght * 1 == $competencia->lft + 1) {
								$leaf = true;
							}
							?>
							<td class="col-sm-8" >
								<?= ($leaf ? '<b>' : '') . str_ireplace('&', "<div class=\"espacamento\"></div>", $competencia->nome) . ($leaf ? '</b>' : '') ?></td>
							<?php
							//Verifica se o registro é um ponta da arvore
							if ($leaf) {
								?>
								<td class="col-sm-3">


									<?php
									$nivel = 0;
									foreach ($profissionais[$co->profissional['id']] as $coi):
										if ($competencia->id == $coi['competencia_id']) {
											$nivel = $coi['nivel'];
										}
									endforeach;
									?>
									<?= $nivel ?>
									&nbsp;
									<?
									if(empty($array_best[$competencia->id]['value']) || $array_best[$competencia->id]['value'] < $nivel ){
										$array_best[$competencia->id]['who']=$co->profissional['nome']." ($nivel)";
										$array_best[$competencia->id]['value'] = $nivel;
									}
									?>
								</td>
							<?php } ?>
						</tr>

					<?php } ?>
				</table>
			</div>
		</div>
		<?
		$prof_impressos[] = $co->profissional['id'];
	}
	?>
</div>
<div class="row">
	<div class="col-md-12">
		<p class="lead">Total de Profissionais: <?=$total_profissionais?></p>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<p class="lead">Melhores Profissionais por Competencia</p>
		<table class="table table-striped table-responsive table-bordered table-condensed table-hover">
			<?php
			foreach ($competencias as $id => $competencia) {
				?>

				<tr>
					<?php
					$leaf = FALSE;
					//Verifica se o registro é um ponta da arvore
					if ($competencia->rght * 1 == $competencia->lft + 1) {
						$leaf = true;
					}
					?>
					<td class="col-sm-8" >
						<?= ($leaf ? '<b>' : '') . str_ireplace('&', "<div class=\"espacamento\"></div>", $competencia->nome) . ($leaf ? '</b>' : '') ?></td>
					<?php
					//Verifica se o registro é um ponta da arvore
					if ($leaf) {
						?>
						<td class="col-sm-3">
							<?= $array_best[$competencia->id]['who'] ?>&nbsp;
						</td>
					<?php } ?>
				</tr>

			<?php } ?>
		</table>
	</div>
</div>

