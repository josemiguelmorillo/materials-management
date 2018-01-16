<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Subjects".
 *
 * @property integer $subject_id
 * @property string $name
 *
 * @property LinesDetails[] $linesDetails
 */
class Subjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Subjects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subject_id' => Yii::t('app', 'Subject ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinesDetails()
    {
        return $this->hasMany(LinesDetails::className(), ['subject_id' => 'subject_id']);
    }
}
