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
        <form @submit.prevent="submit">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input text required error">
                            <label for="nome">Nome completo</label>
                            <input type="text" name="nome" v-model="form.nome" required="required" id="nome" maxlength="255" class="form-control">
                            <div v-if="errors.nome">
                                <div v-for="error in errors.nome" class="error-message">{{error}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input email required">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" required="required" maxlength="255" id="email" class="form-control">
                            <div v-if="errors.email">
                                <div v-for="error in errors.email" class="error-message">{{error}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input text required">
                            <label for="celular">Celular</label>
                            <input type="text" name="celular" required="required" maxlength="15" id="celular" class="form-control">
                            <div v-if="errors.celular">
                                <div v-for="error in errors.celular" class="error-message">{{error}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <t-loading :loading="loadingEstados"></t-loading>
                                <div v-if="!isEmpty(estados) && !loadingEstados" class="input select">
                                    <label for="estado-id">Estado</label>
                                    <select v-model="form.estado_id" name="estado_id" id="estado-id" class="form-control" @change="getCidades()">
                                        <option v-for="estado in estados" :value="estado.id_estado">{{estado.nom_estado}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <t-loading :loading="loadingCidades"></t-loading>
                                <div v-if="!isEmpty(cidades) && !loadingCidades" class="input select">
                                    <label for="cidade-id">Cidade</label>
                                    <select v-model="form.cidade_id" name="cidade_id" id="cidade-id" class="form-control">
                                        <option v-for="cidade in cidades" :value="cidade.id_cidade">{{cidade.nom_cidade}}</option>
                                    </select>
                                </div>
                                <div v-if="errors.cidade_id">
                                    <div v-for="error in errors.cidade_id" class="error-message">{{error}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
    <div class="card my-3">
        <div class="card-header text-white bg-dark">Pessoas cadastradas</div>
        <div class="table-container">
            <table class="table table-light">
                <thead>
                    <tr>
                        <th scope="col"><?= $this->Paginator->sort('nome', 'Nome completo') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('email', 'E-mail') ?></th>
                        <th scope="col"><?= $this->Paginator->sort('celular', 'Celular') ?></th>
                        <th scope="col">Cidade/UF</th>
                        <th scope="col"><?= $this->Paginator->sort('created', 'Cadastrado em') ?></th>
                        <th scope="col" class="actions"><?= __('Ações') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pessoas as $pessoa): ?>
                        <tr>
                            <td><?= h($pessoa->nome) ?></td>
                            <td><?= h($pessoa->email) ?></td>
                            <td><?= h($pessoa->celular) ?></td>
                            <td><?= h($pessoa->cidade->nom_cidade) ?>/<?= h($pessoa->cidade->estado->sgl_estado) ?></td>
                            <td><?= $pessoa->created->format('d/m/Y') ?></td>
                            <td class="actions">
                                <?= $this->Form->postLink(__('Excluir'), ['action' => 'delete', $pessoa->id], ['confirm' => __('Você tem certeza que deseja excluir {0}?', $pessoa->nome)]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
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
echo $this->element('VueComponents/TLoading');
echo $this->Html->script('form-table-pessoas', ['block' => 'script']);
?>
