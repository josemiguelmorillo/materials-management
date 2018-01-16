<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Classes".
 *
 * @property integer $class_id
 * @property string $name
 *
 * @property LinesDetails[] $linesDetails
 */
class Classes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Classes';
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
            'class_id' => Yii::t('app', 'Class ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinesDetails()
    {
        return $this->hasMany(LinesDetails::className(), ['class_id' => 'class_id']);
    }
}
