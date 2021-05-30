<?php


namespace frontend\widgets;


use common\models\Sentence;
use yii\base\Widget;

class SentenceWidget extends Widget
{
    public function run()
    {
        $model = new Sentence();

        return !\Yii::$app->request->queryParams ? $this->render('sentence-widget', ['model' => $model]) : null;
    }
}