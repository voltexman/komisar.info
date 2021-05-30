<?php

/* @var $dataProvider Interview */

use backend\models\Interview;
use yii\helpers\Url;

?>
<div class="sidebar-item recent-posts">
    <div class="sidebar-heading">
        <h2>Останні Інтерв`ю</h2>
    </div>
    <div class="content">
        <ul>
            <?php if ($dataProvider->getModels()) : ?>
                <?php foreach ($dataProvider->getModels() as $interview) : ?>
                    <li><a href="<?= Url::to(['interview/view', 'alias' => $interview->alias]) ?>">
                            <h5><?= $interview->name ?></h5>
                            <span><?= Yii::$app->formatter->asDate($interview->created_at, 'long') ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Інтерв`ю немає</p>
            <?php endif; ?>
        </ul>
    </div>
</div>
