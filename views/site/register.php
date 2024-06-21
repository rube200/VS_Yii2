<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\RegisterForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex justify-content-center">
    <div class="site-register">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to register:</p>

        <div class="row">
            <?php $form = ActiveForm::begin([
                'id' => 'register-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'autocomplete' => true]) ?>

            <?= $form->field($model, 'email')->input('email', ['autocomplete' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['autocomplete' => true]) ?>

            <?= $form->field($model, 'confirm_password')->passwordInput(['autocomplete' => true]) ?>

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'Register-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

