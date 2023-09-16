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
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<?= $this->Html->charset() ?>
		<title>
			<?= $this->fetch('title') ?>
		</title>
		<?= $this->Html->meta('icon') ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">


		<script>
			var APP = "<?= $this->request->webroot ?>"
		</script>	

		<?= $this->Html->css('bootstrap') ?>
		<?= $this->Html->css('style') ?>

		<?= $this->Html->script('jquery') ?>
		<?= $this->Html->script('jquery.mask') ?>
		<?= $this->Html->script('bootstrap') ?>

		<?= $this->fetch('meta') ?>
		<?= $this->fetch('css') ?>
		<?= $this->fetch('script') ?>


		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body role="document">
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<?=$this->element('menu');?>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<?= $this->Flash->render() ?>
				<?= $this->Flash->render('auth') ?>
				<?= $this->fetch('content') ?>
			</div>
			<div id="footer">
				<?php
/*				echo
//				$this->Html->link(
//						$this->Html->image('cake.power.gif', ['alt' => '', 'border' => '0']), 'http://www.cakephp.org/', ['target' => '_blank', 'escape' => false]
//				)
 * 
 */
				?>
			</div>
		</div>
	</body>
</html>
