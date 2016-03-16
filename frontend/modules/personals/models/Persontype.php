<?php

namespace frontend\modules\personals\models;

use Yii;

/**
 * This is the model class for table "l_persontype".
 *
 * @property string $persontype_id
 * @property string $persontype_name
 */
class Persontype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'l_persontype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persontype_id'], 'required'],
            [['persontype_id'], 'string', 'max' => 1],
            [['persontype_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'persontype_id' => 'สถานะ',
            'persontype_name' => 'Persontype Name',
        ];
    }
}
