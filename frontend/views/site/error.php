<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>

<div class="container">
    <div class="row pt-80">
        <div class="col-lg-6 col-md-12 d-lg-block d-none pr-50"><img src="imgs/theme/page-not-found.png" alt="">
        </div>
        <div class="col-lg-6 col-md-12 pl-50 text-md-center text-lg-left">
            <h1 class="mb-30 font-weight-900 page-404">404</h1>
            <p class="">Посилання за яким ви перейшли не дійсне. Такої сторінки не існує або стаття була видалена. Поверніться до головної сторінки та перейдіть за іншим посиланням.
            </p>
            <div class="form-group">
                <button type="submit" class="button button-contactForm mt-30">
                    <a class="text-white" href="<?= Url::home() ?>">На головну</a>
                </button>
            </div>
        </div>
    </div>
</div>
