<?php


namespace backend\controllers;


use backend\models\MailForm;
use Codeception\Module\Yii2;
use frontend\models\Contact;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class MessageController extends Controller
{
    public function actionIndex(): string
    {
        $model = new MailForm();

        $dataProvider = new ActiveDataProvider([
            'query' => Contact::find()->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id): string
    {
        $message = Contact::findOne($id);
        $message->updateAttributes(['status' => Contact::STATUS_VIEWED]);

        return $this->render('view', ['message' => $message]);
    }

    public function actionDelete($id): \yii\web\Response
    {
        $message = Contact::findOne($id);
        $message->delete();

        Yii::$app->session->setFlash('success', 'Сообщение удалено');

        return $this->redirect(['index']);
    }

    public function actionDeleteSelected()
    {
        $items = Yii::$app->request->post('items');
        Contact::deleteAll(['id' => $items]);
        Yii::$app->session->setFlash('success', 'Выбранные сообщения удалены');

        return $this->redirect(['index']);
    }

    public function actionDeleteAll()
    {
        Contact::deleteAll();
        Yii::$app->session->setFlash('success', 'Все сообщения удалены');

        return $this->redirect(['index']);
    }

    public function actionSendMail($id)
    {
        $model = new MailForm();
        $contact = Contact::findOne($id);

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('send-mail', [
                'model' => $model,
                'contact' => $contact
            ]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $contact->updateAttributes(['status' => Contact::STATUS_SENT]);

            Yii::$app->mailer->compose()
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->name])
                ->setTo($contact->email)
                ->setSubject($model->subject)
                ->setTextBody($model->message)
                ->send();

            Yii::$app->session->setFlash('success', 'Ответ отправлен');
        }

        return $this->redirect(['index']);
    }
}