<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_TeachersConsumption".
 *
 * @property int $teacher_id
 * @property int $order_id
 * @property int $id_suborder
 * @property int $item_id
 * @property string $teacher_name
 * @property string $item_name
 * @property string $unit_price
 * @property string $discount
 * @property string $units
 */
class VwTeachersConsumption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vw_TeachersConsumption';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teacher_id', 'order_id', 'id_suborder', 'item_id'], 'integer'],
            [['teacher_name'], 'required'],
            [['unit_price', 'discount', 'units'], 'number'],
            [['teacher_name'], 'string', 'max' => 45],
            [['item_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'teacher_id' => Yii::t('app', 'Teacher ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'id_suborder' => Yii::t('app', 'Id Suborder'),
            'item_id' => Yii::t('app', 'Item ID'),
            'teacher_name' => Yii::t('app', 'Teacher Name'),
            'item_name' => Yii::t('app', 'Item Name'),
            'unit_price' => Yii::t('app', 'Unit Price'),
            'discount' => Yii::t('app', 'Discount'),
            'units' => Yii::t('app', 'Units'),
        ];
    }

    public static function primaryKey() {
        return ['teacher_id', 'order_id', 'id_suborder', 'item_id', 'unit_price', 'discount'];
    }
}
