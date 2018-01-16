<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Teachers".
 *
 * @property integer $teacher_id
 * @property string $name
 *
 * @property LinesDetails[] $linesDetails
 */
class Teachers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Teachers';
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
            'teacher_id' => Yii::t('app', 'Teacher ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinesDetails()
    {
        return $this->hasMany(LinesDetails::className(), ['teacher_id' => 'teacher_id']);
    }
}
