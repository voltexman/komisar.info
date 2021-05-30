<?php


namespace frontend\controllers;


use backend\models\Article;
use blog\components\VisitStatistics;
use blog\helpers\ArticleHelper;
use common\models\Comment;
use common\models\Statistics;
use frontend\models\Favorite;
use frontend\models\Like;
use Yii;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BlogController extends Controller
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()
                ->where(['publication' => Article::PUBLICATION_ON])
                ->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 1,
            ],
        ]);

        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => 'Блог ' . Yii::$app->name
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($alias): string
    {
        $article = Article::findOne(['alias' => $alias]);
        $realId = Yii::$app->session->getFlash('realId');

        if ($article) {
            $comments = new ActiveDataProvider([
                'query' => $article->getComments()
                    ->orderBy(['id' => SORT_DESC]),
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);
            $commentsModel = new Comment();

            $ipAddress = Yii::$app->request->userIP;
            $inFavorite = Favorite::find()
                ->where(['ip_address' => $ipAddress])
                ->andWhere(['article_id' => $article->id])
                ->one();

            $inFavorite ? $inFavorite->delete() : null;
            !ArticleHelper::isViewed($alias) ? ArticleHelper::setViewed($alias) : null;

            return $this->render('view', [
                'article' => $article,
                'realId' => $realId,
                'comments' => $comments,
                'commentsModel' => $commentsModel
            ]);
        }
        throw new NotFoundHttpException();
    }

    public function actionAddComment($id): void
    {
        if (Yii::$app->request->isAjax) {
            $model = new Comment();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->article_id = $id;
                $model->save();
            }
        }
    }

    public function actionToFavorite($id): string
    {
        $ipAddress = Yii::$app->request->userIP;
        $inFavorite = Favorite::find()
            ->where(['ip_address' => $ipAddress])
            ->andWhere(['article_id' => $id])
            ->one();

        if ($inFavorite) {
            $inFavorite->delete();

            return 'removed';
        } else {
            $toFavorite = new Favorite();
            $toFavorite->article_id = $id;
            $toFavorite->save();

            return 'added';
        }
    }

    public function actionFavoriteRemove($id): string|bool
    {
        $ipAddress = Yii::$app->request->userIP;
        $inFavorite = Favorite::find()
            ->where(['ip_address' => $ipAddress])
            ->andWhere(['article_id' => $id])
            ->one();

        return $inFavorite->delete() ? 'removed' : false;
    }

    public function actionAddLike($id): string
    {
        $ipAddress = Yii::$app->request->userIP;
        $like = Like::find()
            ->where(['ip_address' => $ipAddress])
            ->andWhere(['article_id' => $id])
            ->one();

        if ($like) {
            $like->delete();

            return 'removed';
        } else {
            $like = new Like();
            $like->article_id = $id;
            $like->save();

            return 'added';
        }
    }

    public function actionGeoPosition(): void
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');

            $latitude = Yii::$app->request->post('latitude');
            $longitude = Yii::$app->request->post('longitude');
            $accuracy = Yii::$app->request->post('accuracy');

            $statistics = Statistics::findOne($id);

            $statistics->updateAttributes([
                'latitude' => $latitude,
                'longitude' => $longitude,
                'accuracy' => $accuracy
            ]);
        }
    }

    public function actionPageTime(): void
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id');
            $time = Yii::$app->request->post('time');

            VisitStatistics::setViewingTime($id, $time);
        }
    }
}