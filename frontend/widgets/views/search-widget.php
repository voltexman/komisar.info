<?php

use blog\helpers\ArticleHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>
<div class="main-search-form">
    <div class="container">
        <div class=" pt-50 pb-50 ">
            <div class="row mb-20">
                <div class="col-12 align-self-center main-search-form-cover m-auto">
                    <p class="text-center"><span class="search-text-bg">Знайти</span></p>

                    <form action="<?= Url::to(['site/index']) ?>" class="search-header">
                        <div class="input-group w-100">
                            <input type="text" name="SearchArticle[searchString]" class="form-control" placeholder="Введіть ключові слова для пошуку">
                            <div class="input-group-append">
                                <button class="btn btn-search bg-white" type="submit">
                                    <i class="elegant-icon icon_search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="row mt-80 text-center">
                <div class="col-12 font-small suggested-area">
                    <h5 class="suggested font-heading mb-20 text-muted"><strong>Запропоновані варіанти:</strong>
                    </h5>
                    <ul class="list-inline d-inline-block">
                        <?php foreach (ArticleHelper::getActualTags(20) as $tag) : ?>
                            <li class="list-inline-item">
                                <a rel="nofollow" href="/?SearchArticle[searchString]=<?= $tag ?>">#<?= $tag ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>