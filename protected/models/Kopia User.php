<?php

/**
 * This is the model class for table "usr".
 *
 * The followings are the available columns in table 'usr':
 * @property integer $USR_ID
 * @property string $USR_NAZWA
 * @property string $USR_HASLO
 * @property string $USR_FIRSTNAME
 * @property string $USR_LASTNAME
 * @property string $USR_EMAIL
 * @property double $USR_ASSERT
 * @property double $USR_COOPER
 * @property integer $USR_ASSERT_COUNT
 * @property integer $USR_COOPER_COUNT
 * @property string $USR_GROUP
 *
 * The followings are the available model relations:
 * @property Chr[] $chrs
 * @property Neg[] $negs
 * @property Neg[] $negs1
 * @property Ofr[] $ofrs
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USR_ASSERT_COUNT, USR_COOPER_COUNT', 'numerical', 'integerOnly'=>true),
			array('USR_ASSERT, USR_COOPER', 'numerical'),
			array('USR_NAZWA, USR_HASLO', 'length', 'max'=>16),
			array('USR_FIRSTNAME, USR_LASTNAME, USR_EMAIL', 'length', 'max'=>100),
			array('USR_GROUP', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('USR_ID, USR_NAZWA, USR_HASLO, USR_FIRSTNAME, USR_LASTNAME, USR_EMAIL, USR_ASSERT, USR_COOPER, USR_ASSERT_COUNT, USR_COOPER_COUNT, USR_GROUP', 'safe', 'on'=>'search'),
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
			'chrs' => array(self::HAS_MANY, 'Characteristic', 'CHR_USR_ID'),
			'negs' => array(self::HAS_MANY, 'Neg', 'NEG_USR1'),
			'negs1' => array(self::HAS_MANY, 'Neg', 'NEG_USR2'),
			'ofrs' => array(self::HAS_MANY, 'Ofr', 'OFR_NAD_USR_ID'),
		);
	}

	public function Cooperativity()
	{
		return $this->USR_COOPER_COUNT > 0 ? $this->USR_COOPER / $this->USR_COOPER_COUNT : 0;
	}
	
	public function Assertivity()
	{
		return $this->USR_ASSERT_COUNT > 0 ? $this->USR_ASSERT / $this->USR_ASSERT_COUNT : 0;
	}
	
	public function WholeName()
	{
		return $this->USR_FIRSTNAME." ".$this->USR_LASTNAME;
	}

	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'USR_ID' => 'User ID',
			'USR_NAZWA' => 'User Login',
			'USR_HASLO' => 'User Password',
			'USR_FIRSTNAME' => 'First name',
			'USR_LASTNAME' => 'Name',
			'USR_EMAIL' => 'User Email',
			'USR_ASSERT' => 'Assertivity',
			'USR_COOPER' => 'Cooperativity',
			'USR_ASSERT_COUNT' => 'Assertivity Count',
			'USR_COOPER_COUNT' => 'Cooperativity Count',
			'USR_GROUP' => 'Group',
			'USR_WHOLENAME' => 'Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		// $criteria->compare('USR_ID',$this->USR_ID);
		// $criteria->compare('USR_NAZWA',$this->USR_NAZWA,true);
		// $criteria->compare('USR_HASLO',$this->USR_HASLO,true);
		// $criteria->compare('USR_FIRSTNAME',$this->USR_FIRSTNAME,true);
		// $criteria->compare('USR_LASTNAME',$this->USR_LASTNAME,true);
		// $criteria->compare('USR_EMAIL',$this->USR_EMAIL,true);
		// $criteria->compare('USR_ASSERT',$this->USR_ASSERT);
		// $criteria->compare('USR_COOPER',$this->USR_COOPER);
		// $criteria->compare('USR_ASSERT_COUNT',$this->USR_ASSERT_COUNT);
		// $criteria->compare('USR_COOPER_COUNT',$this->USR_COOPER_COUNT);
		// $criteria->compare('USR_GROUP',$this->USR_GROUP,true);
		$criteria->condition = "USR_NAZWA <> 'admin' and USR_NAZWA LIKE '%".$this->USR_NAZWA."%' and USR_FIRSTNAME LIKE '%".$this->USR_FIRSTNAME."%' 
		and USR_LASTNAME LIKE '%".$this->USR_LASTNAME."%' 
		and ( USR_GROUP LIKE '%".$this->USR_GROUP."%' OR USR_GROUP is null )";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}