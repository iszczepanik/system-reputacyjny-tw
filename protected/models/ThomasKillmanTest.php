<?php

/**
 * This is the model class for table "tkt".
 *
 * The followings are the available columns in table 'tkt':
 * @property integer $TKT_ID
 * @property string $TKT_A_QUESTION
 * @property string $TKT_B_QUESTION
 * @property integer $TKT_A_PRF_RESULT
 * @property integer $TKT_B_PRF_RESULT
 *
 * The followings are the available model relations:
 * @property Prf $tKTBPRFRESULT
 * @property Prf $tKTAPRFRESULT
 */
class ThomasKillmanTest extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return ThomasKillmanTest the static model class
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
		return 'tkt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TKT_A_PRF_RESULT, TKT_B_PRF_RESULT', 'required'),
			array('TKT_A_PRF_RESULT, TKT_B_PRF_RESULT', 'numerical', 'integerOnly'=>true),
			array('TKT_A_QUESTION, TKT_B_QUESTION', 'length', 'max'=>256),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TKT_ID, TKT_A_QUESTION, TKT_B_QUESTION, TKT_A_PRF_RESULT, TKT_B_PRF_RESULT', 'safe', 'on'=>'search'),
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
			'tKTBPRFRESULT' => array(self::BELONGS_TO, 'Prf', 'TKT_B_PRF_RESULT'),
			'tKTAPRFRESULT' => array(self::BELONGS_TO, 'Prf', 'TKT_A_PRF_RESULT'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TKT_ID' => 'Tkt',
			'TKT_A_QUESTION' => 'Tkt A Question',
			'TKT_B_QUESTION' => 'Tkt B Question',
			'TKT_A_PRF_RESULT' => 'Tkt A Prf Result',
			'TKT_B_PRF_RESULT' => 'Tkt B Prf Result',
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

		$criteria->compare('TKT_ID',$this->TKT_ID);
		$criteria->compare('TKT_A_QUESTION',$this->TKT_A_QUESTION,true);
		$criteria->compare('TKT_B_QUESTION',$this->TKT_B_QUESTION,true);
		$criteria->compare('TKT_A_PRF_RESULT',$this->TKT_A_PRF_RESULT);
		$criteria->compare('TKT_B_PRF_RESULT',$this->TKT_B_PRF_RESULT);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}