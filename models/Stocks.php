<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Stocks".
 *
 * @property integer $stock_id
 * @property integer $item_id
 * @property integer $unit
 * @property string $comment
 *
 * @property Items $item
 */
class Stocks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Stocks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id'], 'required'],
            [['item_id', 'unit'], 'integer'],
            [['comment'], 'string'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'item_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stock_id' => Yii::t('app', 'Stock ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'unit' => Yii::t('app', 'Unit'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['item_id' => 'item_id']);
    }
}
