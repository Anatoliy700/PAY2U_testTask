<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Offers';

//$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>

<div>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => \yii\grid\SerialColumn::className()],
            [
                'class' => \yii\grid\DataColumn::className(),
                'attribute' => 'name',
                'format' => 'html',
                'value' => function ($model) {
                    /* @var $model \app\models\Offers */
                    return \yii\helpers\Html::a($model->name, \yii\helpers\Url::to(['clicks', 'id' => $model->id]));
                }
            ]
        ],
    ]) ?>
</div>
