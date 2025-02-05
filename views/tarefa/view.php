<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Tarefa $model */

$this->title = 'Tarefa: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Tarefas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['should_center'] = true;

function createActionsButtons($model) {
    $buttons = [
        Html::a(
            Html::tag('i', '', ['class' => 'bi bi-eye']) . ' Lista',
            ['index'],
            ['class' => 'btn btn-success ms-2']
        ),
        Html::a(
            Html::tag('i', '', ['class' => 'bi bi-pencil']) . ' Editar',
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary ms-2']
        ),
        Html::a(
            Html::tag('i', '', ['class' => 'bi bi-trash']) . ' Apagar',
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger ms-2',
                'data' => [
                    'confirm' => 'Quer mesmo apagar esta tarefa?',
                    'method' => 'post',
                ]
            ]
        )
    ];

    return Html::tag(
        'div',
        implode('', $buttons),
        ['class' => 'd-flex justify-content-end px-0 py-1']);
}
?>
<div class="tarefa-view w-50">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo',
            'descricao',
            'data_criacao',
            'data_conclusao',
            'estado',
        ],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    ]) ?>

    <?=
        createActionsButtons($model);
    ?>
</div>
