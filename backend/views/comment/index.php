<?php

use kartik\dialog\Dialog;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

// widget with default options
echo Dialog::widget();

$this->title = 'Все комментарии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <?php foreach ($dataProvider->getModels() as $comment) : ?>
        <?php Pjax::begin(['id' => 'comment-' . $comment->id]) ?>
        <div class="box box-widget" id="<?= $comment->id ?>">
            <div class="box-header with-border">
                <div class="user-block pull-left">
                    <span class="username"><?= StringHelper::truncateWords($comment->name, 3) ?></span>
                    <span class="description">Опубликовано - <?= Yii::$app->formatter->asDate($comment->created_at, 'short') ?> в <?= Yii::$app->formatter->asTime($comment->created_at, 'short') ?></span>
                </div>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <small class="text-muted"><?= $comment->article->name ?></small>
                <p><?= $comment->text ?></p>

                <div class="author-buttons pull-left">
                    <?php if ($comment->author_like) : ?>
                        <span class="text-muted">
                            <i class="fa fa-heart"></i> <b>Отреагировано</b>
                        </span>
                    <?php else: ?>
                        <button type="button" class="btn btn-default btn-xs btn-author-like">
                            <i class="fa fa-heart-o"></i> Нравится
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php if ($comment->replys) : ?>
                <?php foreach ($comment->replys as $reply) : ?>
                    <div class="box-footer box-comments">
                        <div class="box-comment">
                            <img class="img-circle img-sm" src="/backend/web/images/avatar.jpg" alt="User Image">

                            <div class="comment-text">
                                <span class="username">
                                    Максим Комисар
                                    <span class="text-muted pull-right">
                                        <?= Yii::$app->formatter->asDate($reply->created_at, 'short') ?>
                                    </span>
                                </span>
                                <?= Html::encode($reply->text) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="box-footer">
                <form action="<?= Url::to(['comment/add-reply', 'id' => $comment->id]) ?>" method="post" class="add-reply">
                    <div class="input-group">
                        <input type="text" name="Comment[text]" class="form-control input-sm" placeholder="Ответ на комментарий">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary btn-flat">
                                <i class="fa fa-send"></i>
                            </button>
                      </span>
                    </div>
                </form>
            </div>
        </div>
        <?php Pjax::end() ?>
    <?php endforeach; ?>

    <?= LinkPager::widget([
        'pagination' => $dataProvider->getPagination()
    ]) ?>

</div>
