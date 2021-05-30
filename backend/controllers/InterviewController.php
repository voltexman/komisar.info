<?php


namespace backend\controllers;


use backend\models\Interview;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class InterviewController extends Controller
{
    public function actions(): array
    {
        return [
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetImagesAction',
                'url' => '/frontend/web/images/interview/', // Directory URL address, where files are stored.
                'path' => '@frontend/web/images/interview', // Or absolute path to directory where files are stored.
            ],
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => '/frontend/web/images/interview/', // Directory URL address, where files are stored.
                'path' => '@frontend/web/images/interview', // Or absolute path to directory where files are stored.
            ],
            'file-delete' => [
                'class' => 'vova07\imperavi\actions\DeleteFileAction',
                'url' => 'frontend/web/images/interview/', // Directory URL address, where files are stored.
                'path' => '@frontend/web/images/interview', // Or absolute path to directory where files are stored.
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Interview::find()->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new Interview();

        if ($model->load(Yii::$app->request->post()) ) {
            Yii::$app->session->setFlash('success', 'Интервью добавлено');
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Interview::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('success', 'Интервью изменено');
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Interview::findOne($id);
        $model->delete();
        Yii::$app->session->setFlash('success', 'Интервью удалено');

        return $this->redirect(['index']);
    }
}