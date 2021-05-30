<?php


namespace frontend\widgets;


use frontend\models\SearchArticle;
use yii\base\BaseObject;
use yii\base\Widget;

class SearchWidget extends Widget
{
    public function run()
    {
        $searchModel = new SearchArticle();

        return $this->render('search-widget', ['searchModel' => $searchModel]);
    }
}