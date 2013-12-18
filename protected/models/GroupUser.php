<?php

/**
 * This is the model class for table "group_user".
 *
 * The followings are the available columns in table 'group_user':
 * @property integer $group_id
 * @property integer $user_id
 * @property string $type
 *
 * The followings are the available model relations:
 * @property FundyUser $user
 * @property Group $group
 */
class GroupUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $email;
	public function tableName()
	{
		return 'group_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email','email'),
			array('email','checkExist','on' =>'addMember'),
			array('email','checkUnique','on' =>'addMember'),
			array('group_id,type', 'required'),
			array('group_id, user_id', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('group_id, user_id, type', 'safe', 'on'=>'search'),
		);
	}
	
	public function checkExist($attribute , $params) {
        $error_message = Yii::t('app' , 'This user doesn\'t exist');
        $user = User::model()->findByAttributes(array($attribute => $this->$attribute));
		if($user == null) {
            $this->addError($attribute , $error_message);
            return false;
        }
        return true;
    }

    public function checkUnique($attribute , $params) {
        $error_message1 = Yii::t('app' , 'This user\'s already in this group');
        $error_message2 = Yii::t('app' , 'This user was added but didn\'t confirm yet');
        	$groupuser = GroupUser::model()->findByAttributes(
        		array(
        			'group_id' => $this->group_id,
        			'user_id' => $this->user_id
        		)
        	);

        	if($groupuser != null){
        		if($groupuser->status == 'confirmed'){
        			$this->addError($attribute , $error_message1);
        		}else{
        			$this->addError($attribute , $error_message2);
        		}
        		return false;
        	}
    		return true;
    }
/*
	public function addMember( ){
		if(isset($_POST['email']) && isset($_POST['group'])){
			$user = User::model( )->findByAttributes(array('email' => $_POST['email']));
			$group_id = $_POST['group'];
			if($user == null) {
				echo CJSON::encode(array(
					'status'=>false,
					'message'=>'user doesn\'t exist'
				));
			}else{
				$groupuser = GroupUser::model()->findByAttributes(
					array('user_id' => $user->id,
						  'group_id' => $group_id));
				if($groupuser != null){
					echo CJSON::encode(array(
					'status'=>false,
					'message'=>'this user already is group\'s member'
					));
				}
				else{
					$groupuser = new GroupUser( );
					$groupuser->user_id = $user->id;
					$groupuser->group_id = $group_id;
					if($groupuser->save( )){
						echo CJSON::encode(array(
							'status'=>true
						));
					}
				}
			}
		}
		else{
				echo CJSON::encode(array(
					'status'=>false,
					'message'=>'Transmission error'
				));
		}
	}
	*/
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'FundyUser', 'user_id'),
			'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'group_id' => 'Group',
			'user_id' => 'User',
			'type' => 'Type',
		);
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

		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GroupUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
