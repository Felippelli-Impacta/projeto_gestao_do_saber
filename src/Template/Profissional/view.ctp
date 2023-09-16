<!-- File: /src/Template/Profissional/view.ctp -->
<h1><?= h($profissional->nome) ?></h1>

<?php if($contato){ ?>
    <h5><b>Descrição:</b></h5>
    <h5><?= h($contato->descricao) ?></h5>
<?php } ?>
    
<h5><b>Contato(s):</b></h5>
<p>Email: <?= h($profissional->email) ?></p>

<?php if($contato){ ?>
    <p>Telefone: <?= h($contato->numero) ?></p>
<?php } ?>
