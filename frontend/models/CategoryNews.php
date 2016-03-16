<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "l_category_news".
 *
 * @property integer $cat_id
 * @property string $cat_name
 */
class CategoryNews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'l_category_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_name' => 'ประเภทข่าว',
        ];
    }
}
