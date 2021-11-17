<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

?>

<div class="mb-3">
    <?= Html::a('Редактировать профиль', ['/user/edit'], ['class'=>'btn btn-primary']) ?>
    <?= Html::button('Удалить',['class' => 'btn btn-primary','onclick' => "resetDatabase()"]); ?>

</div>

<div id="confirm" class="mb-2" hidden>
    <p>Вы действительно хотите удалить профиль?</p>
    <?= Html::button('Да',['class' => 'warning','onclick' => "confirmYes()"]); ?>
    <?= Html::button('Нет',['class' => 'warning','onclick' => "confirmNo()"]); ?>
</div>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'profile.surname',
        'profile.name',
        'email',
    ],
]) ?>

