				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">SABER</a>

				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-left">
						<li><?= $this->Html->link('Profissionais', ['controller' => 'profissional', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Competências', ['controller' => 'competencia', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Relatório', ['controller' => 'relatorio', 'action' => 'index']) ?></li>
                    </ul>
				</div>
