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
			array('NEG_USR1, NEG_USR2, NEG_CAS_ID, NEG_START_DATE, NEG_END_DATE', 'required'),
			array('NEG_USR1, NEG_USR2, NEG_CAS_ID', 'numerical', 'integerOnly'=>true),
			array('NEG_START_DATE, NEG_END_DATE', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('NEG_ID, NEG_USR1, NEG_USR2, NEG_CAS_ID, NEG_START_DATE, NEG_END_DATE', 'safe', 'on'=>'search'),
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
			'NEG_USR1' => 'Negotiator #1',
			'NEG_USR2' => 'Negotiator #2',
			'NEG_CAS_ID' => 'Negotiation Case',
			'NEG_START_DATE' => 'Start Date',
			'NEG_END_DATE' => 'End Date',
			//'Active' => 'Active',
		);
	}

	public function IsActive()
	{
		$now = new DateTime("now");
		$startDate = new DateTime($this->NEG_START_DATE);
		$endDate = new DateTime($this->NEG_END_DATE);
		
		//var_dump($negotiation->NEG_ID);
		//var_dump($now);
		//var_dump($startDate);
		//var_dump($endDate);
		//var_dump($now >= $startDate);
		//var_dump($now < $endDate);
		
		//2.Has this offer ended with compromise?
		$query = "SELECT * FROM ofr WHERE `OFR_NEG_ID` = '".$this->NEG_ID."' and `OFR_COMPROMISE` = '1'";
		$compromiseOffer = Offer::model()->findBySql($query);//if this has entity then yes.
		
		$result = "";
		
		if (!($now >= $startDate))
		{
			$result .= "no, not yet started";
			return $result;
		}
		if (!($now < $endDate))
		{
			$result .= "no (ended";
			if($compromiseOffer != null)
				$result .= " with compromise)";
			else
				$result .= " without compromise)";
			return $result;	
		}
		
		//var_dump($query);
		//var_dump($compromiseOffer);
		if($compromiseOffer != null)
		{		
			$result .= "no (ended with compromise)";
			return $result;
		}

		return "yes";
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

		if (Yii::app()->user->name != 'admin' && $this->NEG_USR1 != null)
		{
			$criteria->condition="(NEG_USR1 = ".$this->NEG_USR1." OR NEG_USR2 = ".$this->NEG_USR2.")";
			//") AND NEG_START_DATE <= '".date("Y-m-d H:i:s")."' AND NEG_END_DATE >= '".date("Y-m-d H:i:s")."'";
		}
		else
		{
			$criteria->compare('NEG_ID',$this->NEG_ID);
			$criteria->compare('NEG_USR1',$this->NEG_USR1);
			$criteria->compare('NEG_USR2',$this->NEG_USR2);
			$criteria->compare('NEG_CAS_ID',$this->NEG_CAS_ID);
			$criteria->compare('NEG_START_DATE',$this->NEG_START_DATE);
			$criteria->compare('NEG_END_DATE',$this->NEG_END_DATE);
		}
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}