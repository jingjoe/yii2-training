<?php

namespace frontend\modules\personals\models;

use Yii;

/**
 * This is the model class for table "l_marrystatus".
 *
 * @property string $marrystatus_id
 * @property string $marrystatus_name
 */
class Marrystatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'l_marrystatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['marrystatus_id'], 'required'],
            [['marrystatus_id'], 'string', 'max' => 1],
            [['marrystatus_name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'marrystatus_id' => 'Marrystatus ID',
            'marrystatus_name' => 'สถานภาพ',
        ];
    }
}
