<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_Orders".
 *
 * @property int $order_id 	
 * @property string $value_date
 * @property string $academic_year
 * @property string $units
 * @property string $amount
 */
class VwOrders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_Orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id'], 'integer'],
            [['value_date'], 'safe'],
            [['units', 'amount'], 'number'],
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
            'units' => Yii::t('app', 'Units'),
            'amount' => Yii::t('app', 'Amount'),
        ];
    }

    public static function primaryKey() {
        return ['order_id'];
    }
}
