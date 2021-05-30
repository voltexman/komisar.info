<?php


namespace backend\controllers;


use common\models\Comment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class CommentController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Comment::find()
                ->where(['reply' => Comment::NO_REPLY])
                ->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id): string
    {
        $comment = Comment::findOne($id);

        return $this->render('view', ['comment' => $comment]);
    }

    public function actionAuthorLike($id): string
    {
        $comment = Comment::findOne($id);
        $comment->updateAttributes(['author_like' => Comment::AUTHOR_LIKE]);

        return 'liked';
    }

    public function actionAddReply($id): string|bool
    {
        if (\Yii::$app->request->isAjax) {
            $comment = new Comment();
            if ($comment->load(\Yii::$app->request->post())) {
                $comment->name = 'Максим Комісар';
                $comment->comment_id = $id;
                $comment->reply = Comment::AUTHOR_REPLY;
                $comment->save();
                return 'sent';
            }
        }

        return false;
    }
}