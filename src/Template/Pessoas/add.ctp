<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pessoa $pessoa
 */
 $this->assign('title', 'Cadastro de Pessoas');
?>
<div class="card my-3">
    <div class="card-header">Formulário</div>
    <?= $this->Form->create($pessoa) ?>
    <div class="card-body">
        <?= $this->Form->control('nome', ['class' => 'form-control']) ?>
        <?= $this->Form->control('email', ['class' => 'form-control']) ?>
        <?= $this->Form->control('celular', ['class' => 'form-control']) ?>
        <?= $this->Form->control('cidade_id', ['options' => $cidade, 'class' => 'form-control']) ?>
    </div>
    <div class="card-footer">
        <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
<div class="pessoas form large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0">
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
