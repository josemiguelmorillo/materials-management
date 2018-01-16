<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "LineDetails".
 *
 * @property integer $line_detail_id
 * @property integer $degree_id
 * @property integer $teacher_id
 * @property integer $class_id
 * @property integer $subject_id
 *
 * @property Classes $class
 * @property Degrees $degree
 * @property Subjects $subject
 * @property Teachers $teacher
 * @property SubOrderLines $subOrderLineId
 */
class LineDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'LineDetails';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['degree_id', 'teacher_id', 'class_id', 'subject_id'], 'required'],
            [['degree_id', 'teacher_id', 'class_id', 'subject_id'], 'integer'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::className(), 'targetAttribute' => ['class_id' => 'class_id']],
            [['degree_id'], 'exist', 'skipOnError' => true, 'targetClass' => Degrees::className(), 'targetAttribute' => ['degree_id' => 'degree_id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subjects::className(), 'targetAttribute' => ['subject_id' => 'subject_id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teachers::className(), 'targetAttribute' => ['teacher_id' => 'teacher_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'line_detail_id' => Yii::t('app', 'Line Detail ID'),
            'degree_id' => Yii::t('app', 'Degree ID'),
            'teacher_id' => Yii::t('app', 'Teacher ID'),
            'class_id' => Yii::t('app', 'Class ID'),
            'subject_id' => Yii::t('app', 'Subject ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(Classes::className(), ['class_id' => 'class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDegree()
    {
        return $this->hasOne(Degrees::className(), ['degree_id' => 'degree_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subjects::className(), ['subject_id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teachers::className(), ['teacher_id' => 'teacher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubOrderLine()
    {
        return $this->hasOne(SubOrderLines::className(), ['line_detail_id' => 'line_detail_id']);
    }
}
