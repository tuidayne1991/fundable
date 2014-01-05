<?php

/**
 * This is the model class for table "project".
 *
 * The followings are the available columns in table 'project':
 * @property integer $id
 * @property integer $group_id
 * @property integer $group_name
 * @property integer $description
 * @property string $funding_status
 *
 * The followings are the available model relations:
 * @property Group $group
 */
class Project extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('team_id, name, description, funding_status', 'required'),
			array('funding_status', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, team_id, name, description, funding_status', 'safe', 'on'=>'search'),
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
			'team' => array(self::BELONGS_TO, 'Team', 'team_id'),
			'members' => array(self::MANY_MANY, 'User', 'project_user(project_id, user_id)'),
			'tasks' => array(self::HAS_MANY, 'TASK', 'project_id'),
			'specs' => array(self::HAS_MANY, 'Spec', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'team_id' => 'Team',
			'project_name' => 'Project Name',
			'description' => 'Description',
			'funding_status' => 'Funding Status',
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
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('name',$this->name);
		$criteria->compare('description',$this->description);
		$criteria->compare('funding_status',$this->funding_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function addMember($user,$role){
		$member = new ProjectUser;
		$member->role = "manager";
		$member->user_id = $user->id;
		$member->project_id = $this->id;
		if($member->save( ))return true;
		return false;
	}
	public function getMembersArray( ){
		$members = $this->members;
        $memberLst = array();
        foreach($members as $member){
            $memberLst[$member->id] = $member->name;
        }
        return $memberLst;
	}
	
	public function setLogo($status){
		if(!$status){
			Photo::model( )->updateAll(array('status' => false),'owner_id = :owner_id AND type = :type',array(':owner_id' => $this->id,':type' => 'project_logo'));
		}
	}
	public function getUrl(){
		return "/project/view/id/".$this->id;
	}
	public function getProfileUrl(){
		return "/project/view/id/".$this->id;
	}
	public function getLogo( ){
		$photo = Photo::model( )->findByAttributes(
			array(	'owner_id' => $this->id,
					'type' => 'project_logo',
					'status' => true),
			array('limit' => 1));
		if($photo != null){
			return $photo->url;
		}
		return "/images/defaults/project_default.jpg";
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Project the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
