<?php

/**
 * This is the model class for table "OFR".
 *
 * The followings are the available columns in table 'OFR':
 * @property integer $OFR_ID
 * @property integer $OFR_NEG_ID
 * @property integer $OFR_NAD_USR_ID
 * @property string $OFR_DATETIME
 * @property integer $OFR_COMPROMISE
 * @property integer $OFR_SCORE_REC
 * @property integer $OFR_SCORE_NAD
 */
class Offer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Offer the static model class
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
		return 'ofr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
			array('OFR_SCORE_NAD, OFR_SCORE_REC', 'numerical', 'max'=>100, 'min' => 0),
			array('OFR_NEG_ID, OFR_NAD_USR_ID, OFR_COMPROMISE', 'numerical', 'integerOnly'=>true),
			array('OFR_SCORE_REC, OFR_SCORE_NAD', 'numerical'),
			array('OFR_DATETIME', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('OFR_ID, OFR_NEG_ID, OFR_NAD_USR_ID, OFR_DATETIME, OFR_COMPROMISE, OFR_SCORE_REC, OFR_SCORE_NAD', 'safe', 'on'=>'search'),
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
			'Offer_details' => array(self::HAS_MANY, 'Detail', 'DET_OFR_ID'),
			'Offer_negotiation' => array(self::BELONGS_TO, 'Negotiation', 'OFR_NEG_ID'),
			'Offer_sender' => array(self::BELONGS_TO, 'User', 'OFR_NAD_USR_ID'),
			'Offer_threads' => array(self::HAS_MANY, 'Thread', 'THR_OFR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		
	
		return array(
			'OFR_ID' => 'Offer ID',
			'OFR_NEG_ID' => 'Offer Negotiation',
			'OFR_NAD_USR_ID' => 'Offer Sender',
			'OFR_DATETIME' => 'Offer Datetime',
			'OFR_COMPROMISE' => 'Compromise',
			'OFR_SCORE_REC' => "Offer Recipient Score",
			'OFR_SCORE_NAD' => "Offer Sender Score",
		);
	}
	
	public function IsCompromise()
	{
		return $this->OFR_COMPROMISE > 0 ? "COMPROMISE" : "";
	}
	
	public function Score()
	{
		$ret =($this->OFR_NAD_USR_ID == Yii::app()->user->id ? $this->OFR_SCORE_NAD : $this->OFR_SCORE_REC);
		//if (empty($ret)) $ret = "<span style='color: red'>Not Set</span>";
		
		return $ret;
	}
	
	public function isNew()
	{
		$ret = $this->Score();
		if (empty($ret)) $ret = "new!";
		else $ret = "";
		
		return $ret;
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

		$criteria->compare('OFR_ID',$this->OFR_ID);
		$criteria->compare('OFR_NEG_ID',$this->OFR_NEG_ID);
		$criteria->compare('OFR_NAD_USR_ID',$this->OFR_NAD_USR_ID);
		$criteria->compare('OFR_DATETIME',$this->OFR_DATETIME,true);
		$criteria->compare('OFR_COMPROMISE',$this->OFR_COMPROMISE);
		$criteria->compare('OFR_SCORE_REC',$this->OFR_SCORE_REC);
		$criteria->compare('OFR_SCORE_NAD',$this->OFR_SCORE_NAD);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}