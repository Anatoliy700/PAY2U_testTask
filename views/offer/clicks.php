<?php
/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $offer \app\models\Offers */
/* @var $ticket \app\models\Tickets */


$this->title = "Clicks for offer '{$offer->name}'";

$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= $this->title ?></h1>

<?php \yii\widgets\Pjax::begin() ?>

<?php if (Yii::$app->session->hasFlash('saveTicket')): ?>

    <p id="message" class="alert alert-success"
       style="position: fixed; top: 0; left: 0; right: 0; z-index: 99999; text-align: center">
        <?= (Yii::$app->session->getFlash('saveTicket'))[0] ?>
    </p>

    <script>
      setTimeout(function () {
        $('#message').animate({opacity: 'hide'}, 2000);
      }, 2000);
    </script>

<?php endif; ?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => \yii\grid\SerialColumn::className()],
        'id',
        'offer_id',
        'hash',
        'datetime',
        [
            'class' => \yii\grid\CheckboxColumn::className(),
            'name' => 'Tickets[clicksArray]',
            'checkboxOptions' => function ($model) {
                /* @var $model \app\models\Clicks */
                return [
                    'form' => 'ticket-form',
                    'value' => $model->hash,
                ];
            },
        ],
    ],
]) ?>

<?php if ($ticket->hasErrors('clicksArray')): ?>
    <p class="alert-danger"> <?= $ticket->getErrors('clicksArray')[0] ?></p>
<?php endif; ?>

<?php $form = \yii\widgets\ActiveForm::begin([
    'id' => 'ticket-form',
    'method' => 'post',
    'options' => [
        'data' => [
            'pjax' => ''
        ]
    ]
]) ?>

<?= $form->field($ticket, 'order_id')->textInput() ?>
<?= $form->field($ticket, 'order_sum')->textInput() ?>
<?= $form->field($ticket, 'comment')->textInput() ?>

<?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>

<?php \yii\widgets\ActiveForm::end() ?>

<?php \yii\widgets\Pjax::end() ?>