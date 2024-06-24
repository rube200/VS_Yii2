<?php

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use app\views\widget\TableView;
use yii\bootstrap5\Html;

$this->title = 'Tarefas de ' . Yii::$app->user->identity->username;
?>
<div class="site-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <?= TableView::widget([
            'columns' => [
                [
                    'attribute' => 'titulo',
                    'contentOptions' => ['class' => 'col-1'],
                    'format' => 'text',
                    'label' => 'Título da tarefa',

                ],
                [
                    'attribute' => 'descricao',
                    'contentOptions' => ['class' => 'col-6'],
                    'format' => 'text',
                    'label' => 'Descrição',
                ],
                [
                    'attribute' => 'data_criacao',
                    'contentOptions' => ['class' => 'col text-center'],
                    'format' => ['date', 'php: d/m/Y'],
                    'label' => 'Data de Criação',
                ],
                [
                    'attribute' => 'data_conclusao',
                    'contentOptions' => ['class' => 'col text-center'],
                    'format' => ['date', 'php: d/m/Y'],
                    'label' => 'Data de Conclusão',
                ],
                [
                    'attribute' => 'estado',
                    'contentOptions' => ['class' => 'align-middle col-1'],
                    'format' => 'raw',
                    'label' => 'Estado',
                    'value' => function($model) {
                        switch (strtolower($model->estado)) {
                            case 'finalizado':
                                $textColor = 'dark';
                                break;

                            case 'em curso':
                                $textColor = 'success';
                                break;

                            //Pendente and default have the same color
                            case 'pendente':
                            default:
                                $textColor = 'warning';
                                break;
                        }

                        return "<button class=\"bg-$textColor bg-opacity-10 btn btn-outline-$textColor btn-sm opacity-100 px-3 text-nowrap w-100\" disabled>$model->estado</button>";
                    }
                ]
            ],
            'dataProvider' => $dataProvider,
            'emptyText' => 'Nenhuma tarefa encontrada',
            'footer' => [
                    '<button class="btn btn-outline-danger py-1 text-nowrap" style="font-size: 14px"><i class="bi bi-trash"></i> Eliminar</button>',
                    '<button class="btn btn-outline-info ms-2 py-1 text-nowrap" style="font-size: 14px"><i class="bi bi-pencil"></i> Editar</button>',
                    '<button class="btn btn-outline-primary ms-2 py-1 text-nowrap" style="font-size: 14px"><i class="bi bi-plus-lg"></i> Adicionar</button>'
            ],
            'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
            'headerRowOptions' => ['class' => 'align-middle text-center', 'style' => 'font-size: 17px; height: 50px'],
            'layout' => "{items}\n{pager}",
            'options' => ['class' => 'border grid-view px-0 rounded shadow'],
            'rowOptions' => ['class' => 'align-middle'],
            'tableOptions' => ['class' => 'mb-0 table table-hover table-striped']
        ]); ?>
    </div>
</div>
