<?php

/* @var $model SearchArticle */

use backend\models\SearchArticle;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['method' => 'GET']) ?>

<?= $form->field($model, 'name')->textInput(['placeholder' => 'Поиск по названию']) ?>

<?= $form->field($model, 'publication')->widget(Select2::class, [
    'data' => $model->publicationStatus,
    'theme' =>  Select2::THEME_DEFAULT,
    'options' => ['placeholder' => 'Выберите параметр ...'],
    'hideSearch' => true
]); ?>

<?= $form->field($model, 'indexation')->widget(Select2::class, [
    'data' => $model->indexationStatus,
    'theme' => Select2::THEME_DEFAULT,
    'options' => ['placeholder' => 'Выберите параметр ...'],
    'hideSearch' => true
]); ?>

<?= '<label class="control-label">Выберите дату</label>' ?>

<?= DatePicker::widget([
    'model' => $model,
    'attribute' => 'from_date',
    'attribute2' => 'to_date',
    'options' => ['placeholder' => 'Начальная дата'],
    'options2' => ['placeholder' => 'Конечная дата'],
    'type' => DatePicker::TYPE_RANGE,
    'form' => $form,
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'autoclose' => true,
    ]
]); ?>

<br>

<div class="row">
    <div class="col-md-12">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::resetButton('Очистить', ['class' => 'btn btn-primary btn-flat']) ?>
    </div>
</div>

<?php ActiveForm::end() ?>
