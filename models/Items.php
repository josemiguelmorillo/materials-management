<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Items".
 *
 * @property int $item_id
 * @property int $supplier_id
 * @property int $item_category_id
 * @property string $supplier_reference
 * @property string $name
 * @property string $brand
 * @property string $model
 * @property string $description
 * @property string $price
 * @property string $comment
 * @property string $discount
 * @property int $units_package
 * @property string $catalog_page
 *
 * @property ItemCategories $itemCategory
 * @property Suppliers $supplier
 * @property Stocks[] $stocks
 * @property SubOrderLines[] $subOrderLines
 */
class Items extends \yii\db\ActiveRecord
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
            [['supplier_id', 'item_category_id', 'units_package'], 'integer'],
            [['description', 'comment'], 'string'],
            [['price', 'discount'], 'number'],
            [['supplier_reference'], 'string', 'max' => 256],
            [['name'], 'string', 'max' => 50],
            [['brand', 'model', 'catalog_page'], 'string', 'max' => 45],
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
            'item_id' => Yii::t('app', 'Item ID'),
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'item_category_id' => Yii::t('app', 'Item Category ID'),
            'supplier_reference' => Yii::t('app', 'Supplier Reference'),
            'name' => Yii::t('app', 'Name'),
            'brand' => Yii::t('app', 'Brand'),
            'model' => Yii::t('app', 'Model'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'comment' => Yii::t('app', 'Comment'),
            'discount' => Yii::t('app', 'Discount'),
            'units_package' => Yii::t('app', 'Units Package'),
            'catalog_page' => Yii::t('app', 'Catalog Page'),
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
    public function getSubOrderLines()
    {
        return $this->hasMany(SubOrderLines::className(), ['item_id' => 'item_id']);
    }
}
