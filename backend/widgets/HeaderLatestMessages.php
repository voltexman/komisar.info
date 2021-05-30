<?php


namespace backend\widgets;


use frontend\models\Contact;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

/**
 * @property int newMessagesCount
 * @property string $postfix
 */
class HeaderLatestMessages extends Widget
{
    public int $newMessagesCount;

    public string $postfix;

    public function init()
    {
        $this->postfix = '';

        $this->newMessagesCount = Contact::find()
            ->where(['status' => Contact::STATUS_NEW])
            ->count();

        $count = substr($this->newMessagesCount, -1);

        match ($count) {
            0 => $this->postfix = 'новых сообщений',
            1 => $this->postfix = 'новое сообщение',
            2 => $this->postfix = 'новых сообщения',
            default => 'сообщений'
        };

        parent::init();
    }

    public function run(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Contact::find()
                ->where(['status' => Contact::STATUS_NEW])
                ->limit(5),
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => false
        ]);

        return $this->render('header-latest-messages', [
            'dataProvider' => $dataProvider,
            'newMessagesCount' => $this->newMessagesCount,
            'postfix' => $this->postfix
        ]);
    }
}