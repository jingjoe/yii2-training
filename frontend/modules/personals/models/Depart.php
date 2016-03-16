<?php

namespace frontend\modules\personals\models;

use Yii;

/**
 * This is the model class for table "depart".
 *
 * @property integer $dep_id
 * @property string $dep_name
 * @property integer $group_id
 */
class Depart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'depart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id'], 'integer'],
            [['depart_name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'depart_id' => 'Dep ID',
            'depart_name' => 'Dep Name',
            'group_id' => 'Group ID',
        ];
    }
}
