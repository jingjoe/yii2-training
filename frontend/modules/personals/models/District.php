<?php

namespace frontend\modules\personals\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property integer $district_id
 * @property string $district_code
 * @property string $district_name
 * @property integer $amphur_id
 * @property integer $province_id
 * @property integer $geo_id
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_code', 'district_name'], 'required'],
            [['amphur_id', 'province_id', 'geo_id'], 'integer'],
            [['district_code'], 'string', 'max' => 6],
            [['district_name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'district_id' => 'District ID',
            'district_code' => 'District Code',
            'district_name' => 'District Name',
            'amphur_id' => 'Amphur ID',
            'province_id' => 'Province ID',
            'geo_id' => 'Geo ID',
        ];
    }
}
