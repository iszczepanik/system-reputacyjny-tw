<?php

/**
 * This is the model class for table "neg".
 *
 * The followings are the available columns in table 'neg':
 * @property integer $NEG_ID
 * @property integer $NEG_USR1
 * @property integer $NEG_USR2
 * @property integer $NEG_CAS_ID
 * @property string $NEG_START_DATE
 * @property string $NEG_END_DATE
 *
 * The followings are the available model relations:
 * @property Usr $nEGUSR1
 * @property Usr $nEGUSR2
 * @property Cas $nEGCAS
 * @property Ofr[] $ofrs
 */
class Negotiation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Negotiation the static model class
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
		return 'neg';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NEG_USR1, NEG_USR2, NEG_CAS_ID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('NEG_ID, NEG_USR1, NEG_USR2, NEG_CAS_ID', 'safe', 'on'=>'search'),
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
			'negotiator_1' => array(self::BELONGS_TO, 'User', 'NEG_USR1'),
			'negotiator_2' => array(self::BELONGS_TO, 'User', 'NEG_USR2'),
			'negotiation_case' => array(self::BELONGS_TO, 'NegotiationCase', 'NEG_CAS_ID'),
			'negotiation_offers' => array(self::HAS_MANY, 'Offer', 'OFR_NEG_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'NEG_ID' => 'Negotiation ID',
			'NEG_USR1' => 'Negotiation User #1',
			'NEG_USR2' => 'Negotiation User #2',
			'NEG_CAS_ID' => 'Negotiation Case',
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

		$criteria->compare('NEG_ID',$this->NEG_ID);
		$criteria->compare('NEG_USR1',$this->NEG_USR1,false,'OR');
		$criteria->compare('NEG_USR2',$this->NEG_USR2,false,'OR');
		$criteria->compare('NEG_CAS_ID',$this->NEG_CAS_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}