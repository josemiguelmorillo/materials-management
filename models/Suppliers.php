<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Suppliers".
 *
 * @property integer $supplier_id
 * @property string $name
 * @property string $legal_name
 * @property string $cif
 * @property string $address
 * @property string $phone_number
 * @property string $contact_name
 * @property string $contact_phone
 * @property string $www
 * @property string $email
 *
 * @property Items[] $items
 * @property SubOrders[] $subOrders
 */
class Suppliers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Suppliers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'cif'], 'required'],
            [['name', 'legal_name', 'cif', 'address', 'phone_number', 'contact_name', 'contact_phone', 'www', 'email'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'name' => Yii::t('app', 'Name'),
            'legal_name' => Yii::t('app', 'Legal Name'),
            'cif' => Yii::t('app', 'Cif'),
            'address' => Yii::t('app', 'Address'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'contact_name' => Yii::t('app', 'Contact Name'),
            'contact_phone' => Yii::t('app', 'Contact Phone'),
            'www' => Yii::t('app', 'Www'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['supplier_id' => 'supplier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubOrders()
    {
        return $this->hasMany(SubOrders::className(), ['supplier_id' => 'supplier_id']);
    }
}
