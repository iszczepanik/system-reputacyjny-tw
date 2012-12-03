<?php

/**
 * This is the model class for table "cas".
 *
 * The followings are the available columns in table 'cas':
 * @property integer $CAS_ID
 * @property string $CAS_DESC
 *
 * The followings are the available model relations:
 * @property Crt[] $crts
 * @property Neg[] $negs
 */
class NegotiationCase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return NegotiationCase the static model class
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
		return 'cas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CAS_DESC', 'required'),
			array('CAS_DESC', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CAS_ID, CAS_DESC', 'safe', 'on'=>'search'),
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
			'Criterias' => array(self::HAS_MANY, 'Criteria', 'CRT_CAS_ID'),
			'Negotiations' => array(self::HAS_MANY, 'Negotiation', 'NEG_CAS_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CAS_ID' => 'Case ID',
			'CAS_DESC' => 'Case Description',
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

		$criteria->compare('CAS_ID',$this->CAS_ID);
		$criteria->compare('CAS_DESC',$this->CAS_DESC,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}