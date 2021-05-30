<?php


namespace backend\widgets;


use frontend\models\Contact;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class DashboardLatestMessagesList extends Widget
{
    public function run(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Contact::find()->where(['status' => Contact::STATUS_NEW])->orderBy(['id' => SORT_DESC])->limit(7),
            'pagination' => false
        ]);

        return $this->render('dashboard-latest-messages-list', ['dataProvider' => $dataProvider]);
    }
}