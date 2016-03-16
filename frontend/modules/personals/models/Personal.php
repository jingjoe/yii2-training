<?php
namespace frontend\modules\personals\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;

use frontend\modules\personals\models\Religion;
use frontend\modules\personals\models\Marrystatus;
use frontend\modules\personals\models\Position;
use frontend\modules\personals\models\Persontype;
use frontend\modules\personals\models\Education;

use frontend\modules\personals\models\Depart;
use frontend\modules\personals\models\DepartGroup;
use frontend\modules\personals\models\Province;
use frontend\modules\personals\models\Amphur;
use frontend\modules\personals\models\District;
use frontend\modules\personals\models\Zipcode;

use dektrium\user\models\User;


/**
 * This is the model class for table "personal".
 *
 * @property integer $id
 * @property string $cid
 * @property string $pname
 * @property string $fname
 * @property string $lname
 * @property integer $sex
 * @property string $age
 * @property string $religion_id
 * @property string $bloodgroup
 * @property string $marrystatus_id
 * @property string $birthdate
 * @property string $address
 * @property string $province_id
 * @property string $amphur_id
 * @property string $district_id
 * @property string $zip_code
 * @property string $lat
 * @property string $lng
 * @property string $phone
 * @property string $email
 * @property string $skill
 * @property string $education_id
 * @property string $token_upload
 * @property string $img
 * @property string $startwork_date
 * @property string $position_id
 * @property string $salary
 * @property integer $group_id
 * @property integer $depart_id
 * @property string $persontype_id
 * @property string $created_at
 * @property string $updated_at
 */
class Personal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'pname', 'fname', 'lname', 'sex', 'age', 'religion_id', 'bloodgroup', 'marrystatus_id', 'birthdate', 'phone', 'email', 'startwork_date', 'position_id', 'depart_id', 'persontype_id'], 'required'],
            [['sex', 'group_id', 'depart_id'], 'integer'],
            [['bloodgroup', 'address', 'skill', 'img'], 'string'],
            [['birthdate', 'startwork_date', 'created_at', 'updated_at'], 'safe'],
            [['salary'], 'number'],
            [['cid'], 'string', 'max' => 17],
            [['pname'], 'string', 'max' => 50],
            [['fname', 'lname'], 'string', 'max' => 150],
            [['age', 'religion_id', 'position_id'], 'string', 'max' => 2],
            [['marrystatus_id', 'education_id', 'persontype_id'], 'string', 'max' => 1],
            [['province_id', 'amphur_id', 'district_id'], 'string', 'max' => 6],
            [['zip_code'], 'string', 'max' => 10],
            [['lat', 'lng'], 'string', 'max' => 45],
            [['phone'], 'string', 'max' => 11],
            [['email', 'token_upload'], 'string', 'max' => 100]
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
     public function behaviors(){
        return [
            [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'created_at',
            'updatedAtAttribute' => 'updated_at',
            'value' => new Expression('NOW()'),
            ] 
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => 'เลขบัตรประชาชน',
            'pname' => 'คำนำหน้า',
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'sex' => 'เพศ',
            'age' => 'อายุ',
            'religion_id' => 'ศาสนา',
            'bloodgroup' => 'กรุ๊ปเลือด',
            'marrystatus_id' => 'สถานภาพการสมรส',
            'birthdate' => 'วันเกิด',
            'address' => 'ที่อยู่',
            'province_id' => 'จังหวัด',
            'amphur_id' => 'อำเภอ',
            'district_id' => 'ตำบล',
            'zip_code' => 'รหัสไปรษณีย์',
            'lat' => 'ลติจูด',
            'lng' => 'ลองติจูด',
            'phone' => 'โทรศัพท์มือถือ',
            'email' => 'อีเมล์',
            'skill' => 'ความสามารถพิเศษ',
            'education_id' => 'ระดับการศึกษา',
            'token_upload' => 'หลายเลข referent สำหรับอัพโหลดไฟล์ ajax',
            'img' => 'รูปประจำตัว',
            'startwork_date' => 'วันเข้าทำงาน',
            'position_id' => 'ตำแหน่ง',
            'salary' => 'เงินเดือน',
            'group_id' => 'ฝ่าย',
            'depart_id' => 'แผนก',
            'persontype_id' => 'สถานของบุคคล',
            'created_at' => 'วันลงทะเบียน',
            'updated_at' => 'วันอับเดท',
            // เพิ่มฟิวล์ใหม่ จาก funtion get  relation          
            'positionname' => 'ตำแหน่ง',
            'religionname' => 'ศาสนา',
            'marryname' => 'สถานภาพ',
            'educationname' => 'ระดับการศึกษา',
            'positionname' => 'ตำแหน่ง',
            'pertypename' => 'สถานะ',
            'departname' => 'แผนก',
            'departgroupname' => 'ฝ่าย',
            'fullname' => Yii::t('app', 'ชื่อ-นามสกุล'),
            
            'provinceName'=>'จังหวัด',
            'amphurName'=>'อำเภอ',
            'districtName'=>'ตำบล'
        ];
    }
    public static function itemAlias($type,$code=NULL) {
        $_items = array(
            'sex' => array(
                '1' => 'ชาย',
                '2' => 'หญิง',
            ),
                'pname' => array(
                '1' => 'นาย',
                '2' => 'นาง',
                '3' => 'นางสาว',
            ),
        );
        
        if (isset($code)){
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        }
        else{         
            return isset($_items[$type]) ? $_items[$type] : false;    
        }
    }
// get ศาสนา   
    public function getReligion() {
        return @$this->hasOne(Religion::className(), ['religion_id' => 'religion_id']);
    }
    public function getReligionname() {
        return @$this->religion->religion_name;
    }

    
// get สถานะภาพ  
    public function getMarry() {
        return @$this->hasOne(Marrystatus::className(), ['marrystatus_id' => 'marrystatus_id']);
    }
    public function getMarryname() {
        return @$this->marry->marrystatus_name;
    }

// get ระดับการศึกษา    
    public function getEducation() {
        return @$this->hasOne(Education::className(), ['education_id' => 'education_id']);
    }
    public function getEducationname() {
        return @$this->education->education_name;
    }

// get ตำแหน่ง     
    public function getPosition() {
        return @$this->hasOne(Position::className(), ['position_id' => 'position_id']);
    }
    public function getPositionname() {
        return @$this->position->position_name;
    }

// get สถานะบุคคล  
    public function getPertype() {
        return @$this->hasOne(Persontype::className(), ['persontype_id' => 'persontype_id']);
    }
    public function getPertypename() {
        return @$this->pertype->persontype_name;
    }
// get แผนก
    public function getDepart() {
        return @$this->hasOne(Depart::className(), ['depart_id' => 'depart_id']);
    }
    public function getDepartname() {
        return @$this->depart->depart_name;
    }
// get ฝ่าย
    public function getDepartgroup() {
        return @$this->hasOne(DepartGroup::className(), ['group_id' => 'group_id']);
    }
    public function getDepartgroupname() {
        return @$this->departgroup->group_name;
    }
    
// virtual attribute fullName 
    public function getFullname(){
        return $this->pname. $this->fname. "   " .$this->lname;
    }
// จังหวัด อำเภอ ตำบล    
       public function getProvinces(){
        return @$this->hasOne(Province::className(),['province_id'=>'province_id']);
    }
    public function getProvinceName(){
        return @$this->provinces->province_name;
    }

    public function getAmphurs(){
        return @$this->hasOne(Amphur::className(),['amphur_id'=>'amphur_id']);
    }
    public function getAmphurName(){
        return @$this->amphurs->amphur_name;
    }

    public function getDistricts(){
        return @$this->hasOne(District::className(),['district_id'=>'district_id']);
    }
    public function getDistrictName(){
        return @$this->districts->district_name;
    }
    
      public function getZipcode(){
        return @$this->hasOne(Zipcode::className(),['district_id'=>'district_id']);
    }
    public function getZipcodeName(){
        return @$this->zipcode->zipcode;
    }
}
