<?php

use common\models\Sentence;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $model Sentence */
?>
<div class="featured-1 pt-30 pb-30">
    <div class="container">

        <div class="send-info p-30 border-radius-10 wow fadeIn  animated bg-info text-white position-relative d-none">
            <i class="elegant-icon icon_info position-absolute info-icon"></i>
            <div class="send-message"></div>
        </div>

        <div class="row sentence-form">
            <div class="col-lg-6 align-self-center">
                <p class="text-muted"><span class="typewrite d-inline" data-period="2000"
                                            data-type='[ " Цікаві статті. ", "Актуальні новини. ", "Зворотній зв`язок з читачами. " ]'></span>
                </p>
                <h2>Привіт, я <span>Максим</span></h2>
                <h3 class="mb-20"> Ласкаво прошу на мій блог</h3>
                <h5 class="text-muted">Ви також можете самі запропонувати тему для написання статті, яка вас
                    зацікавила...</h5>

                <?php $form = ActiveForm::begin([
                    'action' => Url::to(['site/sentence']),
                    'id' => 'sentenceForm',
                    'options' => ['class' => 'input-group form-subcriber mt-30 d-flex']
                ]) ?>

                <?= $form->field($model, 'theme', [
                    'options' => ['class' => false],
                    'enableClientValidation' => false])
                    ->textInput([
                        'class' => 'form-control bg-white font-small', 'placeholder' => 'Тема статті',
                        'required' => true,
                    ])
                    ->label(false) ?>

                <?= Html::submitButton('Пропонувати', ['class' => 'btn bg-primary text-white']) ?>

                <?php ActiveForm::end() ?>
            </div>
            <div class="col-lg-6 text-right d-none d-lg-block">
                <img src="imgs/authors/featured.png" alt="">
            </div>
        </div>
    </div>
</div>
