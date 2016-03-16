<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use dektrium\user\models\User;
use frontend\models\CategoryNews;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $cat_id
 * @property string $title
 * @property string $detail
 * @property string $img
 * @property string $token_upload
 * @property string $status
 * @property integer $view
 * @property string $create_date
 * @property string $modify_date
 * @property integer $created_by
 * @property integer $updated_by
 */
class News extends \yii\db\ActiveRecord
{
   const DOC_PATH = 'news';
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'title', 'detail'], 'required'],
            [['detail'], 'string'],
            [['view', 'created_by', 'updated_by'], 'integer'],
            [['create_date', 'modify_date','catname'], 'safe'],
            [['cat_id', 'status'], 'string', 'max' => 1],
            [['title'], 'string', 'max' => 255],
            [['token_upload'], 'string', 'max' => 100],
            [['img'], 'file'] //extensions' => 'cds,txt,sql'
        ];
    }
 public function getArray($value)
    {
        return explode(',', $value);
    }

    public function setToArray($value)
    {   
        return is_array($value)?implode(',', $value):NULL;
    }
    /**
     * @inheritdoc
     */
    public function behaviors(){
        return [
            [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'create_date',
            'updatedAtAttribute' => 'modify_date',
            'value' => new Expression('NOW()'),
            ],
            [  
            'class' => BlameableBehavior::className(),
            'createdByAttribute' => 'created_by',
            'updatedByAttribute' => 'updated_by',],  
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'ประเภทข่าว',
            'title' => 'หัวข้อข่าว',
            'detail' => 'รายละเอียดข่าว',
            'img' => 'ภาพข่าว',
            'token_upload' => 'Token Upload',
            'status' => 'สถานะ',
            'view' => 'จำนวนการเข้าชม',
            'create_date' => 'วันบันทึก',
            'modify_date' => 'วันปรับปรุง',
            'created_by' => 'บันทึกโดย',
            'updated_by' => 'อับเดทโดย',
        // เพิ่มฟิวล์ใหม่ จาก funtion get  relation          
            'loginname' => 'ชื่อผู้บันทึก',
            'updatename' => 'ชื่อผู้อับเดท',
            'catname' => 'ประเภทข่าว',
        ];
    }

// get ประเภทข่าว
    public function getCat() {
        return @$this->hasOne(CategoryNews::className(), ['cat_id' => 'cat_id']);
    }
    public function getCatname() {
        return @$this->cat->cat_name;
    }   
// get ชื่อผู้บันทึก
    public function getLogin() {
        return @$this->hasOne(User::className(), ['id' => 'created_by']);
    }
    public function getLoginname() {
        return @$this->login->username;
    }
// get ชื่อผู้อับเดท
    public function getUpdate() {
        return @$this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    public function getUpdatename() {
        return @$this->update->username;
    }
    
    public static function itemAlias($type,$code=NULL) {
        $_items = array(
            'status' => array(
                'Y' => 'เปิด',
                'N' => 'ปิด',
            ),
        );
        
        if (isset($code)){
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        }
        else{         
            return isset($_items[$type]) ? $_items[$type] : false;    
        }
    }
    
}
