<?php

/**
 * This is the model class for table "thr".
 *
 * The followings are the available columns in table 'thr':
 * @property integer $THR_ID
 * @property integer $THR_OFR_ID
 * @property integer $THR_RESP_THR_ID
 * @property string $THR_CONTENT
 * @property integer $THR_IMPORTANCE
 * @property double $THR_TYPE
 *
 * The followings are the available model relations:
 * @property Thread $tHRRESPTHR
 * @property Thread[] $thrs
 * @property Ofr $tHROFR
 */
class Thread extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Thread the static model class
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
		return 'thr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('THR_OFR_ID, THR_RESP_THR_ID, THR_IMPORTANCE', 'numerical', 'integerOnly'=>true),
			array('THR_TYPE', 'numerical'),
			array('THR_CONTENT', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('THR_ID, THR_OFR_ID, THR_RESP_THR_ID, THR_CONTENT, THR_IMPORTANCE, THR_TYPE', 'safe', 'on'=>'search'),
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
			'tHRRESPTHR' => array(self::BELONGS_TO, 'Thread', 'THR_RESP_THR_ID'),
			'thrs' => array(self::HAS_MANY, 'Thread', 'THR_RESP_THR_ID'),
			'tHROFR' => array(self::BELONGS_TO, 'Ofr', 'THR_OFR_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'THR_ID' => 'Thr',
			'THR_OFR_ID' => 'Thr Ofr',
			'THR_RESP_THR_ID' => 'Thr Resp Thr',
			'THR_CONTENT' => 'Thr Content',
			'THR_IMPORTANCE' => 'Thr Importance',
			'THR_TYPE' => 'Thr Type',
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

		$criteria->compare('THR_ID',$this->THR_ID);
		$criteria->compare('THR_OFR_ID',$this->THR_OFR_ID);
		$criteria->compare('THR_RESP_THR_ID',$this->THR_RESP_THR_ID);
		$criteria->compare('THR_CONTENT',$this->THR_CONTENT,true);
		$criteria->compare('THR_IMPORTANCE',$this->THR_IMPORTANCE);
		$criteria->compare('THR_TYPE',$this->THR_TYPE);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}