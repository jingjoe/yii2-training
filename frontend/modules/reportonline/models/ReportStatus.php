<?php

namespace frontend\modules\reportonline\models;

use Yii;

/**
 * This is the model class for table "l_report_status".
 *
 * @property integer $report_status_id
 * @property string $report_status_name
 */
class ReportStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'l_report_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_status_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'report_status_id' => 'Report Status ID',
            'report_status_name' => 'สถานะรายงาน',
        ];
    }
}
