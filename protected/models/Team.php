<?php

/**
 * This is the model class for table "group".
 *
 * The followings are the available columns in table 'group':
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * The followings are the available model relations:
 * @property GroupUser[] $groupUsers
 */
class Team extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'team';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, description', 'required'),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, description', 'safe', 'on'=>'search'),
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
			'teamUsers' => array(self::HAS_MANY, 'TeamUser', 'team_id'),
			'members' => array(self::MANY_MANY, 'User', 'team_user(team_id, user_id)','condition'=>'status = "confirmed"'),
			'pendingMembers' => array(self::MANY_MANY, 'User', 'team_user(team_id, user_id)','condition'=>'status = "pending"'),
			'projects' => array(self::HAS_MANY, 'Project', 'team_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function addMember($owner,$role = "member"){
		$model = TeamUser::model()->findByAttributes(array('user_id'=>$owner->id,'team_id'=>$this->id));
        if(!$model){
            $model = new TeamUser;
            $model->email = $owner->email;
            $model->user_id = $owner->id;
            $model->team_id = $this->id;
            $model->type = $role;
            $model->status = 'confirmed';
            if ($model->save()){
            	return true;

            }    
        }
        return false;
	}

	public function getAllAvailableMembers($project_id){
		$members = $this->members;
        $memberLst = array();
        foreach($members as $member){
        	$membership = ProjectUser::model()->findByAttributes(array('project_id' => $project_id,'user_id' => $member->id));
        	if($membership == null){
            	$memberLst[$member->id] = $member->name;
        	}
        }
        return $memberLst;
	}
    
    public function getUrl(){
        return "/team/view/id/".$this->id;
    }
    
    public function getProfileUrl(){
        return "/team/view/id/".$this->id;
    }

    public function setLogo($status){
        if(!$status){
            Photo::model( )->updateAll(array('status' => false),'owner_id = :owner_id AND type = :type',array(':owner_id' => $this->id,':type' => 'team_logo'));
        }
    }

	public function getMemberIds(){
		$members = $this->members;
        $memberIds = array();
        foreach($members as $member){
            array_push($memberIds, $member->id);
        }
        return $memberIds;
	}

    public function getLogo( ){
        $photo = Photo::model( )->findByAttributes(
            array(  'owner_id' => $this->id,
                    'type' => 'team_logo',
                    'status' => true),
            array('limit' => 1));
        if($photo != null){
            return $photo->url;
        }
        return "/images/defaults/team_default.jpg";
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Group the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
