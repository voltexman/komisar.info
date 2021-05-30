<?php

use backend\models\Interview;
use kartik\form\ActiveField;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use vova07\imperavi\Widget;
use yii\helpers\Html;

//use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model Interview */
/* @var $action string */

$aliasHint = 'Если <b>"Псевдоним"</b> оставить пустым он сформируется автоматически на основе названия интервью';
$youTubeHint = '';

?>
<div class="article">

    <?php $form = ActiveForm::begin(); ?>

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

                    <?= $form->field($model, 'url', [
                        'addon' => ['prepend' => ['content' => '<i class="fa fa-youtube-play"></i>']],
                        'hintType' => ActiveField::HINT_SPECIAL,
                        'hintSettings' => ['placement' => 'right', 'onLabelClick' => true, 'onLabelHover' => false]
                    ])->hint($youTubeHint); ?>

                    <?= $form->field($model, 'text')->widget(Widget::class, [
                        'settings' => [
                            'lang' => 'ru',
                            'minHeight' => 500,
                            'pastePlainText' => true,
                            'imageUpload' => Url::to(['/interview/image-upload']),
                            'imageDelete' => Url::to(['/interview/file-delete']),
                            'imageManagerJson' => Url::to(['/interview/images-get']),
                            'plugins' => [
                                'video',
                                'imagemanager' => 'vova07\imperavi\bundles\ImageManagerAsset',
                                'fontfamily',
                                'fontsize',
                                'fullscreen',
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?php if ($model->url): ?>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">YouTube ролик</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <iframe width="100%" height="250"
                                src="https://www.youtube.com/embed/<?= $model->getVideoUrl($model->url) ?>"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                </div>
            <?php endif; ?>
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
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">SEO</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?= $form->field($model, 'meta_title') ?>

                    <?= $form->field($model, 'meta_keywords')->widget(Select2::class, [
//                        'data' => $data,
                        'hideSearch' => true,
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => ['multiple' => true],
                        'pluginOptions' => [
                            'tags' => true,
                            'tokenSeparators' => [','],
                            'maximumInputLength' => 10
                        ],
                    ]) ?>

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
