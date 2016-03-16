<?php

namespace frontend\modules\personals\models;

use Yii;

/**
 * This is the model class for table "zipcode".
 *
 * @property integer $zipcode_id
 * @property string $district_code
 * @property string $province_id
 * @property string $amphur_id
 * @property string $district_id
 * @property string $zipcode
 */
class Zipcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zipcode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_code', 'province_id', 'amphur_id', 'district_id', 'zipcode'], 'required'],
            [['district_code', 'province_id', 'amphur_id', 'district_id'], 'string', 'max' => 100],
            [['zipcode'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'zipcode_id' => 'Zipcode ID',
            'district_code' => 'District Code',
            'province_id' => 'Province ID',
            'amphur_id' => 'Amphur ID',
            'district_id' => 'District ID',
            'zipcode' => 'Zipcode',
        ];
    }
}
