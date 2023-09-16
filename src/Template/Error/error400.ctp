<?php
use Cake\Core\Configure;
if($code!=401){
?>
<h2><?= h($message);?></h2>
<p class="error">
	<strong><?= __d('cake', 'Error') ?>: </strong>
	<?= sprintf(
		__d('cake', 'The requested address %s was not found on this server.'),
		"<strong>'{$url}'</strong>"
	) ?>
</p>
<?php
if (Configure::read('debug')):
	echo $this->element('exception_stack_trace');
endif;
}else{
?>
<h2><?= h($message);?></h2>
<p class="error">
	<a href="" onclick="javascript:history.back()">VOLTAR</a>
</p>
<?php
if (Configure::read('debug')):
	echo $this->element('exception_stack_trace');
endif;
}
?>
