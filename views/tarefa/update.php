<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tarefa $model */

$this->title = 'Editar Tarefa: ' . $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Tarefas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['should_center'] = true;
$this->params['is_update'] = true;

?>
<div class="tarefa-update w-50">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>
