<!-- File: /src/Template/Saber/index.ctp -->
<?= $this->Html->css('jquery-ui') ?>
<?= $this->Html->script(array('jquery-ui', 'saber/index')) ?>

<p class="lead ten-column floatLeft color000 marginVertical20">
    <?= $this->Html->link('Profissionais', ['controller' => 'Profissional', 'action' => 'index'], ['class' => 'floatLeft color000']) ?><span class="floatLeft">&nbsp; > <?= $profissional->nome ?> > Saber</span>
</p>

<?php
$c = 0;
foreach ($competencias as $id => $competencia):
	?>

	<div class="row" style="border-bottom: 1px #ddd solid;padding: 5px 10px; ">
		<?php
		$leaf = FALSE;
		//Verifica se o registro é um ponta da arvore
		if ($competencia->rght == $competencia->lft + 1) {
			$leaf = true;
		}
		?>
		<div class="col-sm-3"><?= str_ireplace('&', "<div class=\"espacamento\"></div>" . ($leaf ? '<b>' : ''), $competencia->nome) . ($leaf ? '</b>' : '') ?></div>
		<?php
		//Verifica se o registro é um ponta da arvore
		if ($leaf) {
			?>
			<div class="col-sm-8" style="height: 25px">
				<div class="form-group">
					<div class="input-group">

						<div class="slider slider<?= $competencia->id ?> " rel="<?= $competencia->id ?>"></div>
						<div class="input-group-addon" style="margin-left: 10px"><span class="at<?= $competencia->id ?>">0</span></div>
						<?= $this->Form->create('Saber', ['id' => 'form' . $competencia->id, 'url' => ['action' => 'edit', $profissional->id]]); ?>
						<?php
						$nivel = 0;
						foreach ($sabers as $co):
							if ($competencia->id == $co->competencia_id) {
								echo $this->Form->hidden('Saber.id', ['value' => $co->id, 'class' => 'id']);
								$nivel = $co->nivel;
							}
						endforeach;
						?>
						<?= $this->Form->hidden('Saber.competencia_id', ['value' => $competencia->id]); ?>
						<?= $this->Form->hidden('Saber.profissional_id', ['value' => $profissional->id]); ?>
						<?= $this->Form->hidden('Saber.nivel', ['type' => 'text', 'readonly', 'class' => 'nivel at' . $competencia->id, 'rel' => $competencia->id, 'div' => false, 'label' => false, 'value' => $nivel]); ?>
						<?= $this->Form->end(); ?>

					</div>
				</div>
			</div>
		<?php } ?>
	</div>


	<?php
endforeach;
?>

<?php echo $this->Form->end(); ?>

