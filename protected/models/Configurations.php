<?php

/**
 * This is the model class for table "cnf".
 *
 * The followings are the available columns in table 'cnf':
 * @property integer $CNF_ID
 * @property string $CNF_NAME
 * @property string $CNF_VALUE
 */
class Configurations extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Configurations the static model class
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
		return 'cnf';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CNF_NAME, CNF_VALUE', 'required'),
			array('CNF_NAME', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CNF_ID, CNF_NAME, CNF_VALUE', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'CNF_ID' => 'Cnf',
			'CNF_NAME' => 'Cnf Name',
			'CNF_VALUE' => 'Cnf Value',
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

		$criteria->compare('CNF_ID',$this->CNF_ID);
		$criteria->compare('CNF_NAME',$this->CNF_NAME,true);
		$criteria->compare('CNF_VALUE',$this->CNF_VALUE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}