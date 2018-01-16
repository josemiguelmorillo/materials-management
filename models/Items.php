<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "Items".
 *
 * @property integer $item_id
 * @property integer $supplier_id
 * @property integer $item_category_id
 * @property string $supplier_reference
 * @property string $name
 * @property string $brand
 * @property string $model
 * @property string $description
 * @property string $price
 * @property string $comment
 *
 * @property ItemCategories $itemCategory
 * @property Suppliers $supplier
 * @property Stocks[] $stocks
 * @property SubOrdersLines[] $subOrdersLines
 */
class Items extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supplier_id', 'item_category_id', 'supplier_reference'], 'required'],
            [['supplier_id', 'item_category_id'], 'integer'],
            [['description', 'comment'], 'string'],
            [['price'], 'number'],
            [['supplier_reference'], 'string', 'max' => 256],
            [['name', 'brand', 'model'], 'string', 'max' => 45],
            [['item_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemCategories::className(), 'targetAttribute' => ['item_category_id' => 'item_category_id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['supplier_id' => 'supplier_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'supplier_id' => 'Supplier ID',
            'item_category_id' => 'Item Category ID',
            'supplier_reference' => 'Supplier Reference',
            'name' => 'Name',
            'brand' => 'Brand',
            'model' => 'Model',
            'description' => 'Description',
            'price' => 'Price',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCategory()
    {
        return $this->hasOne(ItemCategories::className(), ['item_category_id' => 'item_category_id']);
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
    public function getStocks()
    {
        return $this->hasMany(Stocks::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubOrdersLines()
    {
        return $this->hasMany(SubOrdersLines::className(), ['item_id' => 'item_id']);
    }
}
