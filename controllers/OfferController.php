<?php

namespace app\controllers;

use app\models\Clicks;
use app\models\Offers;
use app\models\Tickets;
use yii\data\ActiveDataProvider;

class OfferController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Offers::find()
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionClicks($id)
    {
        $ticket = new Tickets();
        $ticket->setAttribute('offer_id', $id);
        if ($ticket->load(\Yii::$app->request->post()) && $ticket->save()) {
            \Yii::$app->session->addFlash('saveTicket', 'Успешно сохранено');
            $ticket = new Tickets();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Clicks::find()->where(['offer_id' => $id])
        ]);

        $offer = Offers::findOne(['id' => $id]);

        return $this->render(
            'clicks',
            [
                'dataProvider' => $dataProvider,
                'offer' => $offer,
                'ticket' => $ticket
            ]
        );
    }

}
