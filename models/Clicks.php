<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%clicks}}".
 *
 * @property int $id
 * @property int $offer_id
 * @property string $hash
 * @property string $datetime
 *
 * @property Offers $offer
 */
class Clicks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%clicks}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['offer_id', 'hash'], 'required'],
            [['offer_id'], 'integer'],
            [['hash'], 'string'],
            [['datetime'], 'safe'],
            [['hash'], 'unique'],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offers::className(), 'targetAttribute' => ['offer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'offer_id' => 'Offer ID',
            'hash' => 'Hash',
            'datetime' => 'Datetime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offers::className(), ['id' => 'offer_id']);
    }
}
