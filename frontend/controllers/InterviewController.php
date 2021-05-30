<?php


namespace frontend\controllers;


use backend\models\Interview;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class InterviewController extends Controller
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Interview::find()->where(['publication' => Interview::PUBLICATION_ON])->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        \Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'Інтерв`ю ' . Yii::$app->name
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($alias): string
    {
        $interview = Interview::findOne(['alias' => $alias]);

        return $this->render('view', ['interview' => $interview]);
    }
}