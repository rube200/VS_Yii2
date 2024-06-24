<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\RegisterForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
$this->params['should_center'] = true;
?>
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

        <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
            'template' => Html::tag('div',
            Html::tag('div', '{image}', ['class' => 'col-lg-3']) .
            Html::tag('div', '{input}', ['class' => 'col-lg-6']),
            ['class' => 'justify-content-evenly row']),
        ]) ?>

        <div class="form-group">
            <div>
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

