<?php

/**
 * This is the model class for table "det".
 *
 * The followings are the available columns in table 'det':
 * @property integer $DET_ID
 * @property integer $DET_OFR_ID
 * @property integer $DET_CRT_ID
 * @property string $DET_VALUE
 *
 * The followings are the available model relations:
 * @property Ofr $dETOFR
 * @property Crt $dETCRT
 */
class Detail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Details the static model class
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
		return 'det';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DET_ID, DET_OFR_ID, DET_CRT_ID', 'numerical', 'integerOnly'=>true),
			array('DET_VALUE', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DET_ID, DET_OFR_ID, DET_CRT_ID, DET_VALUE', 'safe', 'on'=>'search'),
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
			'Detail_offer' => array(self::BELONGS_TO, 'Offer', 'DET_OFR_ID'),
			'Detail_criteria' => array(self::BELONGS_TO, 'Criteria', 'DET_CRT_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DET_ID' => 'Detail ID',
			'DET_OFR_ID' => 'Detail Offer',
			'DET_CRT_ID' => 'Detail Criteria',
			'DET_VALUE' => 'Detail Value',
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

		$criteria->compare('DET_ID',$this->DET_ID);
		$criteria->compare('DET_OFR_ID',$this->DET_OFR_ID);
		$criteria->compare('DET_CRT_ID',$this->DET_CRT_ID);
		$criteria->compare('DET_VALUE',$this->DET_VALUE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}