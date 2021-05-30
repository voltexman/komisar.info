<?php

use backend\models\Article;
use kartik\file\FileInput;
use kartik\form\ActiveField;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use vova07\imperavi\Widget;
use yii\helpers\Html;

//use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model Article */
/* @var $action string */

$aliasHint = 'Если <b>"Псевдоним"</b> оставить пустым он сформируется автоматически на основе названия статьи';
$shortTextHint = 'Краткий текст который отображается в списке статей под картинкой';
$tagsHint = 'Ключевые, главные слова из текста, кратко описывающие тему статьи';

?>
<div class="article">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <div class="row">
        <div class="col-md-9">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Общее</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'name', [
                                'addon' => ['prepend' => ['content' => '<i class="fa fa-pencil"></i>']]
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'alias', [
                                'addon' => ['prepend' => ['content' => '<i class="fa fa-globe"></i>']],
                                'hintType' => ActiveField::HINT_SPECIAL,
                                'hintSettings' => ['placement' => 'right', 'onLabelClick' => true, 'onLabelHover' => false]
                            ])->hint($aliasHint); ?>
                        </div>
                    </div>

                    <?= $form->field($model, 'short_text', [
                        'hintType' => ActiveField::HINT_SPECIAL,
                        'hintSettings' => ['placement' => 'right', 'onLabelClick' => true, 'onLabelHover' => false]
                    ])->textarea(['rows' => 6, 'style' => 'resize:none'])->hint($shortTextHint); ?>

                    <?= $form->field($model, 'tags', [
                        'addon' => ['prepend' => ['content' => '<i class="fa fa-tags"></i>']],
                        'hintType' => ActiveField::HINT_SPECIAL,
                        'hintSettings' => ['placement' => 'right', 'onLabelClick' => true, 'onLabelHover' => false]
                    ])
                        ->widget(Select2::class, [
                            'hideSearch' => true,
                            'theme' => Select2::THEME_DEFAULT,
                            'pluginOptions' => [
                                'multiple' => true,
                                'tags' => true,
                                'tokenSeparators' => [',', ' '],
                                'maximumInputLength' => 10
                            ],
                        ])->hint($tagsHint); ?>

                    <?php
                    echo $form->field($model, 'text')->widget(Widget::class, [
                        'settings' => [
                            'lang' => 'ru',
                            'minHeight' => 500,
                            'pastePlainText' => true,
                            'imageUpload' => Url::to(['/article/image-upload']),
                            'imageDelete' => Url::to(['/article/file-delete']),
                            'imageManagerJson' => Url::to(['/article/images-get']),
                            'plugins' => [
                                'video',
                                'imagemanager' => 'vova07\imperavi\bundles\ImageManagerAsset',
                                'fontfamily',
                                'fontsize',
                                'fullscreen',
                            ],
                        ],
                    ]);
                    ?>
                </div>
            </div>
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Аккордеон</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <small>Рекомендуемый размер 1280x720</small>
                    <?= \dvizh\gallery\widgets\Gallery::widget(
                        [
                            'model' => $model,
                            'label' => false,
                            'previewSize' => '150x150',
                            'fileInputPluginLoading' => true,
                            'fileInputPluginOptions' => [
                                'autoOrientImages' => true,
                                'showPreview' => false,
                                'showCaption' => true,
                                'showRemove' => true,
                                'showUpload' => false,
                                'browseLabel' => '',
                            ]
                        ]
                    ); ?>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Изображение</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <small>Рекомендуемый размер 1920х1080</small>
                    <?php if ($model->image): ?>
                        <?= Html::img($model->getThumbFileUrl('image', 'admin_thumb'), ['class' => 'img-responsive']) ?>
                        <br>
                    <?php endif; ?>

                    <?= $form->field($model, 'image')->widget(FileInput::class, [
                        'options' => [
                            'accept' => 'image/*',
                        ],
                        'autoOrientImages' => true,
                        'pluginOptions' => [
                            'showPreview' => false,
                            'showCaption' => true,
                            'showRemove' => true,
                            'showUpload' => false,
                            'browseLabel' => '',
                        ]
                    ])->label(false) ?>
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Параметры</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">

                    <?= $form->field($model, 'publication')->widget(Select2::class, [
                        'data' => $model->publicationStatus,
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => ['placeholder' => 'Выберите параметр ...'],
                        'hideSearch' => true
                    ]); ?>

                    <?= $form->field($model, 'indexation')->widget(Select2::class, [
                        'data' => $model->indexationStatus,
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => ['placeholder' => 'Выберите параметр ...'],
                        'hideSearch' => true
                    ]); ?>

                </div>
            </div>
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">SEO</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?= $form->field($model, 'meta_title') ?>

                    <?= $form->field($model, 'meta_keywords') ?>

                    <?= $form->field($model, 'meta_description')->textarea(['rows' => 6, 'style' => 'resize:none']) ?>

                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($action, ['class' => 'btn btn-success btn-flat']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
