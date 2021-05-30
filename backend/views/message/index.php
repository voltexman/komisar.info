<?php

use backend\models\MailForm;
use frontend\models\Contact;
use kartik\dialog\Dialog;
use kartik\popover\PopoverX;
use yii\bootstrap\Modal;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model MailForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

// widget with default options
echo Dialog::widget();

$js = <<< JS
    var selectedItems = [];

    $(".delete-selected").click(function (event){
        event.preventDefault();
        var url = $(this).attr('href');
        selectedItems = selectedItems.concat($('.grid-view').yiiGridView('getSelectedRows'));
        // select all rows on page 1, go to page 2 and select all rows.
        // All rows on page 1 and 2 will be selected.
        krajeeDialog.confirm("Вы уверены что хотите удалить выбранные сообщения?", function (result) {
            if (result) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {items: selectedItems}
                });
                console.log(selectedItems);
            } else {
                
            }
        });
    });
JS;

$this->registerJs($js);

$this->title = 'Все сообщения';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
Modal::begin([
    'header' => '<h4>Ответ</h4>',
    'options' => ['id' => 'sendMail'],
    'footer' => PopoverX::widget([
            'header' => 'Подсказка',
            'type' => PopoverX::TYPE_INFO,
            'placement' => PopoverX::ALIGN_TOP_RIGHT,
            'content' => 'Ответ отправляется на почту указанную отправителем. Не указав тему письма она укажется автоматически как ответ с сайта ' . Yii::$app->name,
        'toggleButton' => ['label' => Html::tag('span', '', ['class' => 'glyphicon glyphicon-info-sign']), 'class' => 'btn btn-flat'],
    ]) . Html::button('Отменить', ['class' => 'btn btn-danger btn-flat', 'onclick' => '$("#sendMail").modal("hide")']),
]);
?>

<?php Modal::end(); ?>

<div class="message-index">

    <div class="row">
        <div class="col-md-12">
            <div class="btn-group pull-left">
                <button type="button" class="btn btn-danger btn-flat">Удаление</button>
                <button type="button" class="btn btn-danger btn-flat dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="true">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><?= Html::a('Удалить все', ['delete-all'], ['data-confirm' => 'Вы уверены что хотите удалить все сообщения?']) ?></li>
                    <li><?= Html::a('Удалить выбранное', ['delete-selected'], ['class' => 'delete-selected']) ?></li>
                </ul>
            </div>
        </div>
    </div>

    <br>

    <div class="box">
        <div class="box-solid">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => false,
                'columns' => [
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        // you may configure additional properties here
                        'headerOptions' => ['style' => 'width:20px'],
                    ],
                    [
                        'label' => 'Имя',
                        'attribute' => 'name',
                    ],
                    [
                        'label' => 'Почта',
                        'attribute' => 'email',
                        'visible' => !Yii::$app->devicedetect->isMobile(),
                    ],
                    [
                        'class' => '\dosamigos\grid\columns\LabelColumn',
                        'headerOptions' => ['style' => 'width:100px'],
                        'label' => 'Статус',
                        'attribute' => 'status',
                        'labels' => [
                            Contact::STATUS_NEW => [
                                'label' => 'Новое',
                                'options' => [
                                    'class' => 'label-danger'
                                ]
                            ],
                            Contact::STATUS_VIEWED => [
                                'label' => 'Прочитано',
                                'options' => [
                                    'class' => 'label-warning'
                                ]
                            ],
                            Contact::STATUS_SENT => [
                                'label' => 'Отвечено',
                                'options' => [
                                    'class' => 'label-success'
                                ]
                            ]
                        ]
                    ],
                    [
                        'label' => 'Дата и время отправки',
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
                        'template' => '{view} {mail} {delete}',
                        'buttons' => [
                            'mail' => function ($url, $model, $key) {
                                $icon = Html::tag('span', '', ['class' => 'glyphicon glyphicon-envelope']);

                                //Обработка клика на кнопку
                                $js = <<<JS
                                    $("#{$key}").on("click",function(event){  
                                        event.preventDefault();
                                        $("#sendMail").modal("show");
                                        $("#sendMail").find(".modal-body").load($(this).attr("href"));
                                        console.log($key);
                                    });
JS;

                                //Регистрируем скрипты
                                $this->registerJs($js, \yii\web\View::POS_READY, $key);

                                return Html::a($icon, \yii\helpers\Url::to(['message/send-mail', 'id' => $key]), ['id' => $key]);
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
