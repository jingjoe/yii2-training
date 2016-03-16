<?php

namespace frontend\modules\personals\models;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property integer $province_id
 * @property string $province_code
 * @property string $province_name
 * @property integer $geo_id
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province_code', 'province_name'], 'required'],
            [['geo_id'], 'integer'],
            [['province_code'], 'string', 'max' => 2],
            [['province_name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'province_id' => 'Province ID',
            'province_code' => 'Province Code',
            'province_name' => 'Province Name',
            'geo_id' => 'Geo ID',
        ];
    }
}
