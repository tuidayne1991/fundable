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
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	const SPENDING = 0;
	const EARNING = 1;
	public $old_password;
	public $new_password;
	public $re_new_password;
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
			array('email, password', 'required','on' => 'insert'),
			array('is_activated', 'numerical', 'integerOnly'=>true),
			array('email, password', 'length', 'max'=>255),
			array('old_password','checkOldPassword','on' => 'changePassword'),
			array('old_password,new_password,re_new_password','required','on' =>'changePassword'),
			array('new_password', 'compare', 'compareAttribute'=>'re_new_password','on'=>'changePassword'),
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
			'actions' => array(self::HAS_MANY, 'Action', 'owner_id'),
			'groupusers' => array(self::HAS_MANY, 'GroupUser', 'user_id'),
			'groups' => array(self::HAS_MANY, 'Group', 'team_id', 'through'=>'groupusers'),
			'projectusers' => array(self::HAS_MANY, 'ProjectUser', 'user_id'),
			'projects' => array(self::HAS_MANY, 'Project', 'project_id', 'through'=>'projectusers'),
			'tasks' => array(self::HAS_MANY, 'Task', 'assignee_id')
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
			'old_password' => 'Old Password',
			'is_activated' => 'Is Activated',
			're_new_password' => 'Retype New Password'
		);
	}
	public function getTotal_balance( ){
		$total = Yii::app()->db->createCommand()
		->select('sum(balance) as value')
		->from('money_box')
		->where('owner_id = :owner_id', array(':owner_id'=>$this->id))
    	->queryRow();
		return $total['value'] != null ? $total['value']:0;
	}
	
	public function encryptPassword() {
        $this->password = md5($this->password);
    }

	public function checkOldPassword($attribute, $params) {
        $error_message = "Old Password's incorrect";
        if(md5($this->$attribute) == $this->password)return true;
        $this->addError($attribute , $error_message);
        return false;
    }

    public function beforeSave() {
    	if($this->new_password != null){
			$this->password = $this->new_password;
			$this->encryptPassword( );
		}
		return parent::beforeSave();
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
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getAllSpendingTransaction( ){
		$criteria=new CDbCriteria;
		$criteria->addCondition("owner_id =:ownerid");
		$criteria->addCondition("type = :type");
		$criteria->params = array(':ownerid' => $this->id,':type' =>  self::SPENDING);
		$trans = Transaction::model( )->findAll($criteria);
		return $trans;
	}

	public function getAllEarningTransaction( ){
		$criteria=new CDbCriteria;
		$criteria->addCondition("owner_id =:ownerid");
		$criteria->addCondition("type = :type");
		$criteria->params = array(':ownerid' => $this->id,':type' =>  self::EARNING);
		$trans = Transaction::model( )->findAll($criteria);
		return $trans;
	}


}
