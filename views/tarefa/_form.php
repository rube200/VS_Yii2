<?php

use yii\helpers\Html;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Tarefa $model */
/** @var yii\widgets\ActiveForm $form */

$options = [];
if (!empty($this->params['is_update']) && $this->params['is_update'] && $model->estado == 'Finalizado') {
    $options['disabled'] = true;
}
?>

<div class="tarefa-form">
    <?php $form = ActiveForm::begin([
        'id' => 'tarefa-form',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
        'options' => ['class' => 'ajax-form']
    ]); ?>

    <?= $form->field($model, 'titulo')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea() ?>

    <?= $form->field($model, 'estado')->dropDownList([
        'Pendente' => 'Pendente',
        'Em Curso' => 'Em Curso',
        'Finalizado' => 'Finalizado'],
        $options) ?>

    <div class="form-group">
        <div class="d-flex justify-content-end px-0 py-1">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
        $this->registerJsFile(
            '@web/js/ajax-submit.js',
            ['depends' => [JqueryAsset::class]]
        );
    ?>
</div>
