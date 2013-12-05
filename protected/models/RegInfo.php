<?php

/**
 * This is the model class for table "fundy_user".
 *
 * The followings are the available columns in table 'fundy_user':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property integer $is_activated
 *
 * The followings are the available model relations:
 * @property MoneyBox[] $moneyBoxes
 * @property Transaction[] $transactions
 */
class RegInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $re_password;
	public $re_email;

	public function tableName()
	{
		return 'fundy_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password,re_password,re_email', 'required'),
			array('is_activated', 'numerical', 'integerOnly'=>true),
			array('email, password', 'length', 'max'=>255),
			array('email' , 'checkUnique'),
			array('email,re_email' , 'email'),
			array('email', 'compare', 'compareAttribute'=>'re_email'),
			array('password, re_password', 'length', 'min'=>6),
			array('password', 'compare', 'compareAttribute'=>'re_password'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, password, is_activated', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'moneyBoxes' => array(self::HAS_MANY, 'MoneyBox', 'owner_id'),
			'transactions' => array(self::HAS_MANY, 'Transaction', 'owner_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Email',
			're_email' => 'Confirm Email',
			'password' => 'Password',
			're_password' => 'Confirm Password',
			'is_activated' => 'Is Activated',
		);
	}

	public function beforeSave() {
		$this->password = md5($this->password);
		return parent::beforeSave();
	}
	public function encryptPassword() {
        # TODO: use salt?
        # if(md5(md5($this->password).$user->salt)!==$user->password)
        #Yii::log(__FUNCTION__."> encryptPassword password before hash = " . $this->password, 'debug');
        $this->password = md5($this->password);
        #Yii::log(__FUNCTION__."> encryptPassword password after  hash = " . $this->password, 'debug');
    }
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('is_activated',$this->is_activated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RegInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function checkUnique($attribute , $params) {
        $error_message = ($attribute == 'email') ? Yii::t('app' , 'This email is already taken') : Yii::t('app' , 'This phone number is already taken') ;
        if(User::model()->countByAttributes(array($attribute => $this->$attribute)) > 0) {
            $this->addError($attribute , $error_message);
            return false;
        }

        return true;
    }

}
