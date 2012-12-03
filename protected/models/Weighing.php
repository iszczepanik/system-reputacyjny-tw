<?php

/**
 * This is the model class for table "wgh".
 *
 * The followings are the available columns in table 'wgh':
 * @property integer $WGH_ID
 * @property integer $WGH_USR_ID
 * @property integer $WGH_CRT_ID
 * @property string $WGH_PREF
 * @property integer $WGH_VALUE
 * @property double $WGH_WEIGHT
 * @property double $WGH_PIS
 * @property double $WGH_NIS
 * @property double $WGH_P
 *
 * The followings are the available model relations:
 * @property Crt $wGHCRT
 * @property Usr $wGHUSR
 */
class Weighing extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Weighing the static model class
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
		return 'wgh';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('WGH_USR_ID, WGH_CRT_ID, WGH_PREF, WGH_WEIGHT, WGH_PIS, WGH_NIS, WGH_P', 'required'),
			array('WGH_USR_ID, WGH_CRT_ID, WGH_VALUE', 'numerical', 'integerOnly'=>true),
			array('WGH_WEIGHT, WGH_PIS, WGH_NIS, WGH_P', 'numerical'),
			array('WGH_PREF', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('WGH_ID, WGH_USR_ID, WGH_CRT_ID, WGH_PREF, WGH_VALUE, WGH_WEIGHT, WGH_PIS, WGH_NIS, WGH_P', 'safe', 'on'=>'search'),
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
			'weighing_criterion' => array(self::BELONGS_TO, 'Criteria', 'WGH_CRT_ID'),
			'weighing_user' => array(self::BELONGS_TO, 'User', 'WGH_USR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'WGH_ID' => 'Weighing Id',
			'WGH_USR_ID' => 'User',
			'WGH_CRT_ID' => 'Criterion',
			'WGH_PREF' => 'Preference',
			'WGH_VALUE' => 'Value',
			'WGH_WEIGHT' => 'Weight',
			'WGH_PIS' => 'Pis',
			'WGH_NIS' => 'Nis',
			'WGH_P' => 'P',
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

		$criteria->compare('WGH_ID',$this->WGH_ID);
		$criteria->compare('WGH_USR_ID',$this->WGH_USR_ID);
		$criteria->compare('WGH_CRT_ID',$this->WGH_CRT_ID);
		$criteria->compare('WGH_PREF',$this->WGH_PREF,true);
		$criteria->compare('WGH_VALUE',$this->WGH_VALUE);
		$criteria->compare('WGH_WEIGHT',$this->WGH_WEIGHT);
		$criteria->compare('WGH_PIS',$this->WGH_PIS);
		$criteria->compare('WGH_NIS',$this->WGH_NIS);
		$criteria->compare('WGH_P',$this->WGH_P);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}