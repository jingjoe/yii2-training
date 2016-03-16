<?php

namespace frontend\modules\reportonline\models;

use Yii;

/**
 * This is the model class for table "l_report_type".
 *
 * @property integer $reporttype_id
 * @property string $reporttype_name
 */
class ReportType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'l_report_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reporttype_name'], 'required'],
            [['reporttype_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'reporttype_id' => 'ไอดีประเภทรายงาน',
            'reporttype_name' => 'ชื่อประเภทรายงาน',
        ];
    }
}
