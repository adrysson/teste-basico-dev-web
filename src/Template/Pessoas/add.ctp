<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pessoa $pessoa
 */
 $this->assign('title', 'Cadastro de Pessoas');
 $this->Paginator->setTemplates([
     'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
     'prevDisabled' => '<li class="page-item"><a class="page-link" href="javascript:;">{{text}}</a></li>',
     'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
     'nextDisabled' => '<li class="page-item"><a class="page-link" href="javascript:;">{{text}}</a></li>',
     'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
 ]);
?>
<div id="app">
    <div class="card my-3">
        <div class="card-header text-white bg-dark">Formulário</div>
        <?= $this->Form->create($pessoa) ?>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?= $this->Form->control('nome', ['class' => 'form-control']) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('email', ['class' => 'form-control']) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('celular', ['class' => 'form-control']) ?>
                </div>
                <div class="col-md-6">
                    <?= $this->Form->control('estado_id', ['options' => $estados, 'class' => 'form-control']) ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?= $this->Form->button(__('Salvar'), ['class' => 'btn btn-success']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="card my-3">
        <div class="card-header text-white bg-dark">Pessoas cadastradas</div>
        <table class="table table-light">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('nome') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('celular') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('cidade_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created', 'Criado em') ?></th>
                    <th scope="col" class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pessoas as $pessoa): ?>
                    <tr>
                        <td><?= $this->Number->format($pessoa->id) ?></td>
                        <td><?= h($pessoa->nome) ?></td>
                        <td><?= h($pessoa->email) ?></td>
                        <td><?= h($pessoa->celular) ?></td>
                        <td><?= h($pessoa->cidade->nom_cidade) ?></td>
                        <td><?= $pessoa->created->format('d/m/Y') ?></td>
                        <td class="actions">
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pessoa->id], ['confirm' => __('Você tem certeza que deseja excluir {0}?', $pessoa->nome)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="card-footer">
            <p class="float-left"><?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}, exibindo {{current}} registro(s) de um total de {{count}}')]) ?></p>
            <ul class="pagination float-right">
                <?php
                echo $this->Paginator->prev('«');
                echo $this->Paginator->numbers();
                echo $this->Paginator->next('»');
                ?>
            </ul>
        </div>
    </div>
</div>

<?php
$this->start('script');

echo $this->element('VueComponents/estados');
echo $this->element('VueComponents/cidades');
?>
<script>
const app = new Vue({
    el: '#app',
    components: {
        estados,
        cidades
    }
})
</script>

<?php $this->end() ?>
