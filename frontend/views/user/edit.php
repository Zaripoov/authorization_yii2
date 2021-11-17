<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([]); ?>

<?= $form->field($profile, 'surname')->input('text', ['maxlength' => true]) ?>

<?= $form->field($profile, 'name')->input('text', ['maxlength' => true]) ?>

<?= $form->field($user, 'email')->input('email', ['maxlength' => true, 'disabled' => 'disabled', 'value' => $user->email]) ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
</div>

<?php ActiveForm::end(); ?>