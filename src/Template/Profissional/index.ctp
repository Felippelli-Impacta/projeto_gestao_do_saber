<!-- File: /src/Template/Profissional/index.ctp -->
<p class="lead">
    <?= $this->Html->link('Profissionais', ['controller' => 'profissional', 'action' => 'index'], ['class' => 'floatLeft color000 marginVertical20']) ?>
</p>
<?=$this->Html->link('Adicionar',
    ['controller' => 'Profissional', 'action' => 'add'],
    ['class'=>'btn btn-success floatRight marginBottom10']
);?>
<table class="table table-condensed table-striped table-responsive">
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Email</th>
        <th></th>
    </tr>
        <?php foreach ($profissionals as $profissional){ ?>
        <tr>
            <td><?= $profissional->id ?></td>
            <td><?= $profissional->nome ?></td>
            <td><?= $profissional->email ?></td>

            <td>
                <div class="floatRight">
                    <?php
//                    echo $this->Html->link('Conhecimentos', [
//                        'controller' => 'Conhecimento',
//                        'action' => 'index',
//                        $profissional->id
//                    ],['class' => 'btn btn-black']);
                    ?>
                    <?= $this->Html->link('Editar', ['action' => 'edit', $profissional->id],['class' => 'btn btn-primary']) ?>
                    <?= $this->Form->postLink('Excluir', ['action' => 'delete', $profissional->id], ['confirm' => 'Você tem certeza?', 'class' => 'btn btn-danger']) ?>
                </div>
            </td>
        </tr>

    <?php } ?>
</table>
