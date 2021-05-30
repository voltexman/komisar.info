<?php

use backend\models\Article;
use backend\models\SearchArticle;
use kartik\dialog\Dialog;
use yii\bootstrap\Modal;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel SearchArticle */
/* @var $dataProvider yii\data\ActiveDataProvider */

// widget with default options
echo Dialog::widget();

$this->title = 'Все статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index box box-primary">

    <?php Modal::begin([
        'options' => ['id' => 'viewModal'],
        'header' => 'Информация',
        'footer' => Html::button('Закрыть', ['class' => 'btn btn-primary btn-flat', 'onclick' => '$("#viewModal").modal("hide")'])
    ]);

    Modal::end();
    ?>

    <div class="box-header with-border">
        <?= Html::a('<i class="fa fa-plus"></i> Добавить статью', ['create'], ['class' => 'btn btn-success btn-flat']) ?>

        <?php Modal::begin(
            [
                'toggleButton' => ['label' => '<i class="fa fa-search"></i> Найти', 'class' => 'btn btn-primary btn-flat pull-right'],
                'header' => 'Поиск',
            ]);

        echo $this->render('_search', ['model' => $searchModel]);

        Modal::end(); ?>
    </div>

    <div class="box-body table-responsive no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'summary' => false,
            'columns' => [
                [
                    'label' => 'Название статьи',
                    'attribute' => 'name',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::a($data->name, Url::to(['article/update', 'id' => $data->id]));
                    }
                ],
                [
                    'class' => '\dosamigos\grid\columns\LabelColumn',
                    'headerOptions' => ['style' => 'width:100px'],
                    'visible' => !Yii::$app->devicedetect->isMobile(),
                    'label' => false,
                    'attribute' => 'publication',
                    'labels' => [
                        Article::PUBLICATION_ON => [
                            'label' => 'Публикуется',
                            'options' => [
                                'class' => 'label-success'
                            ]
                        ],
                        Article::PUBLICATION_OFF => [
                            'label' => 'Не публикуется',
                            'options' => [
                                'class' => 'label-danger'
                            ]
                        ]
                    ]
                ],
                [
                    'class' => '\dosamigos\grid\columns\LabelColumn',
                    'headerOptions' => ['style' => 'width:100px'],
                    'visible' => !Yii::$app->devicedetect->isMobile(),
                    'label' => false,
                    'attribute' => 'indexation',
                    'labels' => [
                        Article::INDEXATION_ON => [
                            'label' => 'Индексируется',
                            'options' => [
                                'class' => 'label-success'
                            ]
                        ],
                        Article::INDEXATION_OFF => [
                            'label' => 'Не индексируется',
                            'options' => [
                                'class' => 'label-danger'
                            ]
                        ]
                    ]
                ],
                [
                    'label' => 'Дата и время публикации',
                    'attribute' => 'created_at',
                    'headerOptions' => ['style' => 'width:250px'],
                    'visible' => !Yii::$app->devicedetect->isMobile(),
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Html::tag('i', '&nbsp', ['class' => 'fa fa-calendar']) .
                            Yii::$app->formatter->asDate($data->created_at, 'long') . ' ' .
                            Html::tag('i', '&nbsp', ['class' => 'fa fa-clock-o']) .
                            Yii::$app->formatter->asTime($data->created_at, 'short');
                    }
                ],
                [
                    'class' => ActionColumn::class,
                    'header' => 'Действия',
                    'headerOptions' => ['style' => 'width:100px;text-align:center'],
                    'contentOptions' => ['style' => 'text-align:center'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            $icon = Html::tag('span', '', ['class' => 'fa fa-eye']);
                            $url = Url::to(['article/view', 'id' => $key]);
                            $options = [
                                'id' => $key
                            ];

                            $js = <<<JS
                                    $("#{$key}").on("click",function(event){  
                                            event.preventDefault();
                                            var url = $(this).attr("href");
                                            $("#viewModal").modal("show");
                                            $("#viewModal").find(".modal-body").load(url);
                                        }
                                    );
                                JS;

                            //Регистрируем скрипты
                            $this->registerJs($js, \yii\web\View::POS_READY, $key);

                            return Html::a($icon, $url, $options);
                        }
                    ]
                ],
            ],
        ]); ?>
    </div>
</div>
