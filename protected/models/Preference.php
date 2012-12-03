<?php

/**
 * This is the model class for table "prf".
 *
 * The followings are the available columns in table 'prf':
 * @property integer $PRF_ID
 * @property string $PRF_VALUE
 * @property string $PRF_DESC
 *
 * The followings are the available model relations:
 * @property Chr[] $chrs
 * @property Tkt[] $tkts
 * @property Tkt[] $tkts1
 */
class Preference extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Preference the static model class
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
		return 'prf';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PRF_VALUE', 'length', 'max'=>256),
			array('PRF_DESC', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PRF_ID, PRF_VALUE, PRF_DESC', 'safe', 'on'=>'search'),
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
			'chrs' => array(self::HAS_MANY, 'Chr', 'CHR_PRF_ID'),
			'tkts' => array(self::HAS_MANY, 'Tkt', 'TKT_A_PRF_RESULT'),
			'tkts1' => array(self::HAS_MANY, 'Tkt', 'TKT_B_PRF_RESULT'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PRF_ID' => 'Prf',
			'PRF_VALUE' => 'Prf Value',
			'PRF_DESC' => 'Prf Desc',
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

		$criteria->compare('PRF_ID',$this->PRF_ID);
		$criteria->compare('PRF_VALUE',$this->PRF_VALUE,true);
		$criteria->compare('PRF_DESC',$this->PRF_DESC,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}