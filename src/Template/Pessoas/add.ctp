<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pessoa $pessoa
 */
 $this->assign('title', 'Cadastro de Pessoas');
?>
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
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pessoas as $pessoa): ?>
            <tr>
                <td><?= $this->Number->format($pessoa->id) ?></td>
                <td><?= h($pessoa->nome) ?></td>
                <td><?= h($pessoa->email) ?></td>
                <td><?= h($pessoa->celular) ?></td>
                <td><?= $pessoa->has('cidade') ? $this->Html->link($pessoa->cidade->id_cidade, ['controller' => 'Cidade', 'action' => 'view', $pessoa->cidade->id_cidade]) : '' ?></td>
                <td><?= h($pessoa->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pessoa->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pessoa->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pessoa->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pessoa->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
