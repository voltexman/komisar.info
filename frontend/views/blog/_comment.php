<?php

use yii\helpers\Html;
?>

<?php if ($model) : ?>
    <?php foreach ($model as $comment) : ?>
        <div class="comment-list wow fadeIn animated">
            <div class="single-comment justify-content-between d-flex">
                <div class="user justify-content-between d-flex">
                    <div class="desc">
                        <p class="comment"><?= Html::encode($comment->text) ?></p>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <h5>
                                    <i class="elegant-icon icon_profile"></i> <?= Html::encode($comment->name) ?>
                                </h5>
                                <p class="date"><i class="elegant-icon icon_calendar"></i>
                                    <?= Yii::$app->formatter->asRelativeTime($comment->created_at) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p class="text-muted text-center">Коментарі відсутні</p>
<?php endif; ?>