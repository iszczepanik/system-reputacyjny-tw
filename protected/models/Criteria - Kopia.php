<?php

/**
 * This is the model class for table "CRT".
 *
 * The followings are the available columns in table 'CRT':
 * @property integer $CRT_ID
 * @property integer $CRT_CAS_ID
 * @property string $CRT_NAME
 * @property integer $CRT_MAX
 * @property integer $CRT_MIN
 */
class Criteria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Criteria the static model class
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
		return 'crt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CRT_NAME, CRT_MAX, CRT_MIN', 'required'),
			array('CRT_CAS_ID, CRT_MAX, CRT_MIN', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CRT_ID, CRT_CAS_ID, CRT_NAME, CRT_MAX, CRT_MIN, CRT_VALUES', 'safe', 'on'=>'search'),
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
			'Criteria_case' => array(self::BELONGS_TO, 'NegotiationCase', 'CRT_CAS_ID'),
			'Offer_details' => array(self::HAS_MANY, 'Detail', 'DET_CRT_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CRT_ID' => 'Criterion ID',
			'CRT_CAS_ID' => 'Criterion Case',
			'CRT_NAME' => 'Criterion Name',
			'CRT_MAX' => 'Max Value',
			'CRT_MIN' => 'Min Value',
			'CRT_VALUES' => 'Values',
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

		$criteria->compare('CRT_ID',$this->CRT_ID);
		$criteria->compare('CRT_CAS_ID',$this->CRT_CAS_ID);
		$criteria->compare('CRT_NAME',$this->CRT_NAME,true);
		$criteria->compare('CRT_MAX',$this->CRT_MAX);
		$criteria->compare('CRT_MIN',$this->CRT_MIN);
		$criteria->compare('CRT_VALUES',$this->CRT_VALUES);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}