<?php


namespace backend\controllers;


use backend\models\Article;
use backend\models\SearchArticle;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;

class ArticleController extends Controller
{
    public function actions(): array
    {
        return [
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetImagesAction',
                'url' => '/frontend/web/images/article/', // Directory URL address, where files are stored.
                'path' => '@frontend/web/images/article', // Or absolute path to directory where files are stored.
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => '/frontend/web/images/article/', // Directory URL address, where files are stored.
                'path' => '@frontend/web/images/article', // Or absolute path to directory where files are stored.
            ],
            'file-delete' => [
                'class' => 'vova07\imperavi\actions\DeleteFileAction',
                'url' => 'frontend/web/images/article/', // Directory URL address, where files are stored.
                'path' => '@frontend/web/images/article', // Or absolute path to directory where files are stored.
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new SearchArticle();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) ) {
            Yii::$app->session->setFlash('success', 'Статья добавлена');
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Article::findOne($id);
        $model->tags = Json::decode($model->tags);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('success', 'Статья изменена');
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Article::findOne($id);
        $model->delete();
        Yii::$app->session->setFlash('success', 'Статья удалена');

        return $this->redirect(['index']);
    }

    public function actionView($id): string
    {
        $model = Article::findOne($id);

        return $this->renderAjax('view', ['model' => $model]);
    }
}