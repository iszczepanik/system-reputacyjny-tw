<?php

/**
 * This is the model class for table "chr".
 *
 * The followings are the available columns in table 'chr':
 * @property integer $CHR_ID
 * @property integer $CHR_USR_ID
 * @property integer $CHR_PRF_ID
 * @property integer $CHR_VALUE
 *
 * The followings are the available model relations:
 * @property Prf $cHRPRF
 * @property Usr $cHRUSR
 */
class Characteristic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Characteristic the static model class
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
		return 'chr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CHR_USR_ID, CHR_PRF_ID, CHR_VALUE', 'required'),
			array('CHR_USR_ID, CHR_PRF_ID, CHR_VALUE', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CHR_ID, CHR_USR_ID, CHR_PRF_ID, CHR_VALUE', 'safe', 'on'=>'search'),
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
			'preference' => array(self::BELONGS_TO, 'Preference', 'CHR_PRF_ID'),
			'cHRUSR' => array(self::BELONGS_TO, 'Usr', 'CHR_USR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CHR_ID' => 'Chr',
			'CHR_USR_ID' => 'Chr Usr',
			'CHR_PRF_ID' => 'Chr Prf',
			'CHR_VALUE' => 'Chr Value',
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

		$criteria->compare('CHR_ID',$this->CHR_ID);
		$criteria->compare('CHR_USR_ID',$this->CHR_USR_ID);
		$criteria->compare('CHR_PRF_ID',$this->CHR_PRF_ID);
		$criteria->compare('CHR_VALUE',$this->CHR_VALUE);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}