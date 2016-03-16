<?php

namespace frontend\modules\personals\models;

use Yii;

/**
 * This is the model class for table "l_religion".
 *
 * @property string $religion_id
 * @property string $religion_name
 */
class Religion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'l_religion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['religion_id'], 'required'],
            [['religion_id'], 'string', 'max' => 2],
            [['religion_name'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'religion_id' => 'ศาสนา',
            'religion_name' => 'ศาสนา',
        ];
    }
}
