<?php

use backend\models\MailForm;
use frontend\models\Contact;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $model MailForm */
/* @var $contact Contact */

?>

<?= DetailView::widget([
    'model' => $contact,
    'attributes' => [
        [
            'label' => 'Имя',
            'attribute' => 'name'
        ],
        [
            'label' => 'Текст',
            'attribute' => 'text'
        ]
    ]
]) ?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'subject') ?>

<?= $form->field($model, 'message')->textarea(['rows' => 6, 'style' => 'resize:none']) ?>

<div class="form-group">
    <?= Html::submitButton('Ответить', ['class' => 'btn btn-primary btn-flat', 'name' => 'contact-button']) ?>
</div>

<?php ActiveForm::end(); ?>
