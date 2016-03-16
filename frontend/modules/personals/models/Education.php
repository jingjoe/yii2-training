<?php
namespace frontend\modules\personals\models;

use Yii;

/**
 * This is the model class for table "l_education".
 *
 * @property string $education_id
 * @property string $education_name
 */
class Education extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'l_education';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['education_id'], 'required'],
            [['education_id'], 'string', 'max' => 1],
            [['education_name'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'education_id' => 'Education ID',
            'education_name' => 'การศึกษา',
        ];
    }
}
