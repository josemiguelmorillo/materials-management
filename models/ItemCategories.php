<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ItemCategories".
 *
 * @property integer $item_category_id
 * @property string $name
 *
 * @property Items[] $items
 */
class ItemCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ItemCategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_category_id' => Yii::t('app', 'Item Category ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['item_category_id' => 'item_category_id']);
    }
}
