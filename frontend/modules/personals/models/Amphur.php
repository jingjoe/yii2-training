<?php
namespace frontend\modules\personals\models;

use Yii;

/**
 * This is the model class for table "amphur".
 *
 * @property integer $amphur_id
 * @property string $amphur_code
 * @property string $amphur_name
 * @property integer $geo_id
 * @property integer $province_id
 */
class Amphur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'amphur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amphur_code', 'amphur_name'], 'required'],
            [['geo_id', 'province_id'], 'integer'],
            [['amphur_code'], 'string', 'max' => 4],
            [['amphur_name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'amphur_id' => 'Amphur ID',
            'amphur_code' => 'Amphur Code',
            'amphur_name' => 'Amphur Name',
            'geo_id' => 'Geo ID',
            'province_id' => 'Province ID',
        ];
    }
}
