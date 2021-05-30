<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model Contact */

use dmstr\widgets\Alert;
use frontend\models\Contact;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Надіслати листа - Komisar.Info';
?>
<div class="entry-header entry-header-style-2 pb-80 pt-80 mb-50 text-white"
     style="background-image: url(imgs/news/news-17.jpg)">
    <div class="container entry-header-content">
        <h1 class="entry-title mb-50 font-weight-900">
            Листування
        </h1>
    </div>
</div>
<div class="pb-30">
    <div class="container single-content">
        <div class="entry-wraper mt-50">
            <p class="font-large">Для мене дуже важливий зворотній зв`язок з читачами.
                Це допомагає мені розвиватись і ставати краще, а контенту якісніше. Напишіть запитання чи побажання, що
                би Ви хотіли додати, змінити чи покращити.</p>

            <div class="send-info p-30 mt-30 border-radius-10 wow fadeIn  animated bg-info text-white position-relative d-none">
                <i class="elegant-icon icon_info position-absolute info-icon"></i>
                <h5 class="sender-name"></h5>
                <p class="font-medium">Я отримав Вашого листа. Найближчим часом я його розгляну та дам відповідь на
                    вказану вами поштову адресу <b class="sender-email"></b></p>
            </div>

            <div class="contact-form">
                <h1 class="mt-30">Надішліть мені листа</h1>
                <hr class="wp-block-separator is-style-wide">

                <?php $form = ActiveForm::begin(['id' => 'contactForm']); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <?= $form->field($model, 'name')
                            ->textInput(['placeholder' => 'Ваше ім`я'])
                            ->label(false) ?>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <?= $form->field($model, 'email')
                            ->textInput(['placeholder' => 'Ваш email'])
                            ->label(false) ?>
                    </div>
                    <div class="col-lg-12">
                        <?= $form->field($model, 'text')
                            ->textarea(['rows' => 6, 'placeholder' => 'Повідомлення ', 'style' => 'resize:none'])
                            ->label(false) ?>

                        <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha2::class)->label(false) ?>
                    </div>
                    <div class="col-lg-12">
                        <?= Html::submitButton('Надіслати', ['class' => 'button button-contactForm']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
