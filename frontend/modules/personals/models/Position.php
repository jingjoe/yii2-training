<?php

namespace frontend\modules\personals\models;

use Yii;

/**
 * This is the model class for table "l_position".
 *
 * @property string $position_id
 * @property string $position_name
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'l_position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_id'], 'required'],
            [['position_id'], 'string', 'max' => 2],
            [['position_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'position_id' => 'Position ID',
            'position_name' => 'ตำแหน่ง',
        ];
    }
}
