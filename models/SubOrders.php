<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SubOrders".
 *
 * @property integer $id_suborder
 * @property integer $order_id
 * @property integer $supplier_id
 *
 * @property Orders $order
 * @property Suppliers $supplier
 * @property SubOrdersLines[] $subOrdersLines
 */
class SubOrders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SubOrders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'supplier_id'], 'required'],
            [['order_id', 'supplier_id'], 'integer'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'order_id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['supplier_id' => 'supplier_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_suborder' => Yii::t('app', 'Id Suborder'),
            'order_id' => Yii::t('app', 'Order ID'),
            'supplier_id' => Yii::t('app', 'Supplier ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Suppliers::className(), ['supplier_id' => 'supplier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubOrdersLines()
    {
        return $this->hasMany(SubOrdersLines::className(), ['id_suborder' => 'id_suborder']);
    }
}
