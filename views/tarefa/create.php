<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Tarefa $model */

$this->title = 'Criar nova tarefa';
$this->params['breadcrumbs'][] = ['label' => 'Tarefas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['should_center'] = true;
?>
<div class="site-create-tarefa w-50">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
