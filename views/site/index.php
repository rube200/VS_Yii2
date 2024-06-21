<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\bootstrap5\Html;
use yii\grid\GridView;

$this->title = 'Tarefas de ' . Yii::$app->user->identity->username;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?= GridView::widget([
            'columns' => [
                [
                    'attribute' => 'titulo',
                    'contentOptions' => ['class' => 'w-auto'],
                    'format' => 'text',
                    'label' => 'Título da tarefa',

                ],
                [
                    'attribute' => 'descricao',
                    'contentOptions' => ['class' => 'w-auto'],
                    'format' => 'text',
                    'label' => 'Descrição',
                ],
                [
                    'attribute' => 'data_criacao',
                    'contentOptions' => ['class' => 'w-auto'],
                    'format' => ['date', 'php: d/m/Y'],
                    'label' => 'Data de Criação',
                ],
                [
                    'attribute' => 'data_conclusao',
                    'contentOptions' => ['class' => 'w-auto'],
                    'format' => ['date', 'php: d/m/Y'],
                    'label' => 'Data de Conclusão',
                ],
                [
                    'contentOptions' => ['class' => 'w-auto'],
                    'format' => 'raw',
                    'label' => 'Estado'
                ]
            ],
            'dataProvider' => $dataProvider,
            'emptyText' => 'Nenhuma tarefa encontrada',
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
            'layout' => "{items}\n{pager}",
            'options' => ['class' => 'border grid-view px-0 rounded'],
            'tableOptions' => ['class' => 'mb-0 table table-hover table-striped'],
        ]); ?>
    </div>
</div>
