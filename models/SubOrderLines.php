<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "SubOrderLines".
 *
 * @property integer $suborder_line_id
 * @property integer $id_suborder
 * @property integer $item_id
 * @property integer $unit
 * @property string $unit_price
 * @property string $discount
 * @property integer $line_detail_id
 * @property int $receipt_unit
 *
 * @property Items $item
 * @property LineDetails $lineDetail
 * @property SubOrders $idSuborder
 */
class SubOrderLines extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'SubOrderLines';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_suborder', 'item_id', 'line_detail_id'], 'required'],
            [['id_suborder', 'item_id', 'unit', 'line_detail_id', 'receipt_unit'], 'integer'],
            [['unit_price', 'discount'], 'number'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'item_id']],
            [['line_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => LineDetails::className(), 'targetAttribute' => ['line_detail_id' => 'line_detail_id']],
            [['id_suborder'], 'exist', 'skipOnError' => true, 'targetClass' => SubOrders::className(), 'targetAttribute' => ['id_suborder' => 'id_suborder']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'suborder_line_id' => Yii::t('app', 'Suborder Line ID'),
            'id_suborder' => Yii::t('app', 'Id Suborder'),
            'item_id' => Yii::t('app', 'Item ID'),
            'unit' => Yii::t('app', 'Unit'),
            'unit_price' => Yii::t('app', 'Unit Price'),
            'discount' => Yii::t('app', 'Discount'),
            'line_detail_id' => Yii::t('app', 'Line Detail ID'),
            'receipt_unit' => Yii::t('app', 'Receipt Unit'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLineDetail()
    {
        return $this->hasOne(LineDetails::className(), ['line_detail_id' => 'line_detail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSuborder()
    {
        return $this->hasOne(SubOrders::className(), ['id_suborder' => 'id_suborder']);
    }
}
