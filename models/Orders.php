<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Orders".
 *
 * @property integer $order_id
 * @property string $value_date
 * @property string $academic_year
 *
 * @property SubOrders[] $subOrders
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value_date'], 'required'],
            [['value_date'], 'safe'],
            [['academic_year'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'Order ID'),
            'value_date' => Yii::t('app', 'Value Date'),
            'academic_year' => Yii::t('app', 'Academic Year'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubOrders()
    {
        return $this->hasMany(SubOrders::className(), ['order_id' => 'order_id']);
    }
}
