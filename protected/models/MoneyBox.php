<?php

/**
 * This is the model class for table "money_box".
 *
 * The followings are the available columns in table 'money_box':
 * @property integer $id
 * @property integer $owner_id
 * @property double $balance
 * @property double $capacity
 * @property string $currency
 *
 * The followings are the available model relations:
 * @property FundyUser $owner
 * @property Transaction[] $transactions
 */
class MoneyBox extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'money_box';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner_id, balance, currency, source', 'required'),
			array('owner_id', 'numerical', 'integerOnly'=>true),
			array('balance', 'numerical'),
			array('currency', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, owner_id, balance, currency', 'safe', 'on'=>'search'),
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
			'owner' => array(self::BELONGS_TO, 'FundyUser', 'owner_id'),
			'transactions' => array(self::HAS_MANY, 'Transaction', 'box_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'owner_id' => 'Owner',
			'balance' => 'Balance',
			'currency' => 'Currency',
			'source' => 'Name',
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
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('balance',$this->balance);
		$criteria->compare('currency',$this->currency,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MoneyBox the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function getMoneyBoxListOption( ){
		$criteria = new CDbCriteria();
		$criteria->condition = "owner_id =:ownerid";
		$criteria->params = array(':ownerid' => Yii::app()->user->_id);
		$results = MoneyBox::model( )->findAll($criteria);

        $boxLst = array();
        if($results){
            foreach($results as $r){
                $boxLst[$r['id']]=$r['source'];
            }
        }
        return $boxLst;

	}
	public static function getTypeListOption( ){
		$types = array( );
		$types[true] = 'Earning';
		$types[false] = 'Spending';
		return $types;
	}
}
