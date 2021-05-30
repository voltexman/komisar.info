<?php

use blog\helpers\ArticleHelper;
use backend\models\Article;
use kartik\detail\DetailView;

/* @var $model Article */
?>

<?= DetailView::widget([
    'model' => $model,
    'condensed' => true,
    'responsive' => false,
    'mode' => DetailView::MODE_VIEW,
    'attributes' => [
        'name', 'alias',
        [
            'label' => 'Ссылка',
            'format' => 'raw',
            'value' => ArticleHelper::getArticleUrl($model->alias)
        ],
        'meta_title', 'meta_description',
        [
            'columns' => [
                [
                    'label' => 'Символов',
                    'value' => ArticleHelper::getSymbolsCount($model->text)
                ],
                [
                    'label' => 'Слов',
                    'value' => ArticleHelper::getWordsCount($model->text)
                ],
            ]
        ],
        [
            'columns' => [
                [
                    'label' => 'Публикация',
                    'value' => $model->publication ? 'Да' : 'Нет'
                ],
                [
                    'label' => 'Индексация',
                    'value' => $model->indexation ? 'Да' : 'Нет'
                ],
            ]
        ],
        [
            'columns' => [
                [
                    'label' => 'Изображений',
                    'value' => ArticleHelper::getImagesCount($model->text)
                ],
                [
                    'label' => 'Аккордеон',
                    'value' => ArticleHelper::hasAccordion($model->id)
                ],
            ]
        ]
    ],
]);
?>
