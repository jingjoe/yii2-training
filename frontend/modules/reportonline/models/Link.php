<?php

namespace frontend\modules\reportonline\models;

use Yii;

/**
 * This is the model class for table "l_link".
 *
 * @property integer $link_id
 * @property string $link_name
 */
class Link extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'l_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'link_id' => 'Link ID',
            'link_name' => 'แหล่งดาวน์โหลด',
        ];
    }
}
