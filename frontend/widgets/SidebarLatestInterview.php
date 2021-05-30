<?php


namespace frontend\widgets;


use backend\models\Interview;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class SidebarLatestInterview extends Widget
{
     public function run(): string
     {
         $dataProvider = new ActiveDataProvider([
             'query' => Interview::find()->orderBy(['id' => SORT_DESC])->limit(3),
             'pagination' => false
         ]);

         return $this->render('sidebar-latest-interview', ['dataProvider' => $dataProvider]);
     }
}