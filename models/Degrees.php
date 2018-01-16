<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Degrees".
 *
 * @property integer $degree_id
 * @property string $name
 *
 * @property LinesDetails[] $linesDetails
 */
class Degrees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Degrees';
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
            'degree_id' => Yii::t('app', 'Degree ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinesDetails()
    {
        return $this->hasMany(LinesDetails::className(), ['degree_id' => 'degree_id']);
    }
}
