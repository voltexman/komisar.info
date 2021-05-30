<?php

/* @var $dataProvider Contact */

/* @var $newMessagesCount integer */

/* @var $postfix string */

use frontend\models\Contact;
use yii\helpers\StringHelper;
use yii\helpers\Url;

$css = <<< CSS
.navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a>h4,
 .navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a>p {
 margin: 0 0!important;
}
CSS;

$this->registerCss($css, ["type" => "text/css"], "myStyles");

?>
<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-envelope-o"></i>
        <?php if ($newMessagesCount > 0) : ?>
            <span class="label label-success"><?= $newMessagesCount ?></span>
        <?php endif; ?>
    </a>
    <ul class="dropdown-menu">
        <?php if ($newMessagesCount > 0) : ?>
            <li class="header">У Вас <?= $newMessagesCount . ' ' . $postfix ?></li>
        <?php else: ?>
            <li class="header">У Вас нет новых сообщений</li>
        <?php endif; ?>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <?php foreach ($dataProvider->getModels() as $message) : ?>
                    <li><!-- start message -->
                        <a href="<?= Url::to(['message/view', 'id' => $message->id]) ?>">
                            <h4>
                                <?= StringHelper::truncate($message->name, '20') ?>
                                <small><i class="fa fa-calendar"></i> <?= Yii::$app->formatter->asDate($message->created_at, 'short') ?>
                                </small>
                            </h4>
                            <p><?= StringHelper::truncate($message->text, '25') ?></p>
                        </a>
                    </li>
                    <!-- end message -->
                <?php endforeach; ?>
            </ul>
        </li>
        <li class="footer"><a href="<?= Url::to(['message/index']) ?>">Открыть все сообщения</a></li>
    </ul>
</li>
