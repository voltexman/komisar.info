<?php


namespace backend\controllers;


use common\models\Sentence;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class SentenceController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Sentence::find()
                ->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
}