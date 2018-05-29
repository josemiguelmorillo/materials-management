<?php
/**
 * Created by PhpStorm.
 * User: josemiguelmorillocallejon
 * Date: 27/02/18
 * Time: 06:50
 */

namespace app\models;


use yii\base\Model;

class UploadCatalogForm extends Model
{

    public $catalog_file;
    public $item_category_id;
    public $supplier_id;

    public function rules()
    {
        return [
            [['catalog_file', 'item_category_id', 'supplier_id'], 'required'],
            [['catalog_file'], 'file', 'checkExtensionByMimeType' => false, 'skipOnEmpty' => false, 'extensions' => 'csv'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'catalog_file' => \Yii::t('app', 'Catalog File Name'),
            'supplier_id' => \Yii::t('app', 'Supplier ID'),
            'item_category_id' => \Yii::t('app', 'Item Category ID'),
        ];
    }

}