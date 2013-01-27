<?php

/**
 * This is the model class for table "wgh".
 *
 * The followings are the available columns in table 'wgh':
 * @property integer $WGH_ID
 * @property integer $WGH_USR_ID
 * @property integer $WGH_CRT_ID
 * @property string $WGH_PREF
 * @property string $WGH_VALUES
 * @property double $WGH_WEIGHT
 * @property double $WGH_PIS
 * @property double $WGH_NIS
 * @property double $WGH_P
 * @property integer $WGH_IMPORTANCE
 * @property integer $WGH_MIDLESCORE
 *
 * The followings are the available model relations:
 * @property Usr $wGHUSR
 * @property Crt $wGHCRT
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
			array('WGH_USR_ID, WGH_CRT_ID, WGH_PREF', 'required'),
			array('WGH_USR_ID, WGH_CRT_ID, WGH_IMPORTANCE, WGH_MIDLESCORE', 'numerical', 'integerOnly'=>true),
			array('WGH_WEIGHT, WGH_PIS, WGH_NIS, WGH_P', 'numerical'),
			array('WGH_PREF', 'length', 'max'=>64),
			array('WGH_VALUES', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('WGH_ID, WGH_USR_ID, WGH_CRT_ID, WGH_PREF, WGH_VALUES, WGH_WEIGHT, WGH_PIS, WGH_NIS, WGH_P, WGH_IMPORTANCE, WGH_MIDLESCORE', 'safe', 'on'=>'search'),
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
			'WGH_ID' => '#',
			'WGH_USR_ID' => 'User',
			'WGH_CRT_ID' => 'Criterion',
			'WGH_PREF' => 'Preference',
			'WGH_VALUES' => 'Values',
			'WGH_WEIGHT' => 'Weight',
			'WGH_PIS' => 'Pis',
			'WGH_NIS' => 'Nis',
			'WGH_P' => 'P',
			'WGH_IMPORTANCE' => 'Importance',
			'WGH_MIDLESCORE' => 'Midlescore',
		);
	}
	
	protected function afterSave() 
	{
        parent::afterSave();
        if (!$this->isNewRecord) 
		{
			$others = $this->Others;
			$weight_sum = $this->WeightSumOfOther + $this->WGH_IMPORTANCE;
			foreach ($others as $wgh_id)
			{
				$wgh = Weighing::model()->findByPk($wgh_id['WGH_ID']);
				$wgh->CalculateStuff($weight_sum, $this->weighing_criterion);
				Weighing::model()->updateByPk($wgh->WGH_ID, array('WGH_WEIGHT'=>$wgh->WGH_WEIGHT));
			}
        }
	}
	
	public function GetWeightSumOfOther()
	{
		$cas_id = $this->weighing_criterion->Criteria_case->CAS_ID;
		return Yii::app()->db->createCommand('
			SELECT SUM(w.`WGH_IMPORTANCE`) FROM `wgh` w LEFT OUTER JOIN `crt` c
			ON w.`WGH_CRT_ID` = c.`CRT_ID`
			WHERE c.`CRT_CAS_ID` = '.$cas_id.'
			AND w.`WGH_ID` <> '.$this->WGH_ID)->queryScalar();
	}
	
	public function GetOthers()
	{
		$cas_id = $this->weighing_criterion->Criteria_case->CAS_ID;
		return Yii::app()->db->createCommand('
			SELECT w.`WGH_ID` FROM `wgh` w LEFT OUTER JOIN `crt` c
			ON w.`WGH_CRT_ID` = c.`CRT_ID`
			WHERE c.`CRT_CAS_ID` = '.$cas_id.'
			AND w.`WGH_ID` <> '.$this->WGH_ID)->queryAll();
	}
	
	public function GetMiddleValue()
	{
		if (!$this->WGH_VALUES == "")
		{
			$middle_index = ceil(($this->ValuesCount + 1) / 2) - 1;
			$values = array_filter(explode(",", $this->WGH_VALUES));
			return $values[$middle_index];
		}
		return null;
	}
	
	public function GetMiddleValueNormalized()
	{
		if (!$this->WGH_VALUES == "")
		{
			$middle_value = ceil(($this->ValuesCount + 1) / 2);
			return $this->Normalize($middle_value, 1, $this->ValuesCount);
		}
		return null;
	}
	
	public function GetValuesCount()
	{
		if (!$this->WGH_VALUES == "")
		{
			$values = array_filter(explode(",", $this->WGH_VALUES));
			return count($values);
		}
		return null;
	}
	
	public function GetValueOf($value)
	{
		if (!$this->WGH_VALUES == "")
		{
			$values = array_filter(explode(",", $this->WGH_VALUES));
			foreach ($values as $key=>$v)
				if ($v == $value)
					return $key+1;
		}
		return null;
	}
	
	public function Normalize($x, $xNis, $xPis)
	{
		return ($x - $xNis) / ($xPis - $xNis);
	}
	
	public function GetCriterionName()
	{
		return $this->weighing_criterion->CRT_NAME;
	}
	
	public function GetCriterionMin()
	{
		if ($this->WGH_VALUES == "")
			return $this->weighing_criterion->CRT_MIN;
		else
			return 1;
	}
	
	public function GetCriterionMax()
	{
		if ($this->WGH_VALUES == "")
			return $this->weighing_criterion->CRT_MAX;
		else
			return $this->ValuesCount;
	}
	
	public function GetXAxisCategories()
	{
		if ($this->WGH_VALUES != "")
		{
			$values = array_filter(explode(",", $this->WGH_VALUES));
			return "['".implode("','", $values)."']";
		}
		return null;
	}
	
	public function GetChartData()
	{
		if ($this->WGH_VALUES == "")
		{
			//najpierw jakie mamy min i max?
			$min = $this->weighing_criterion->CRT_MIN;
			$max = $this->weighing_criterion->CRT_MAX;
			//wyznaczamy punkty poœrednie
			$avg = ($min + $max) / 2;
			$avg_min = ($min + $avg) / 2; 
			$avg_max = ($avg + $max) / 2;
			//to jeszcze 4
			$p1 = ($min + $avg_min) / 2;
			$p3 = ($avg_min + $avg) / 2;
			$p5 = ($avg + $avg_max) / 2;
			$p7 = ($avg_max + $max) / 2;
			
			//jakie mamy pis i nis?
			$nis = $this->WGH_NIS;
			$pis = $this->WGH_PIS;
			
			//obliczamy
			$min_val = 1 - pow((1 - $this->Normalize($min, $nis, $pis)),$this->WGH_P);
			$max_val = 1 - pow((1 - $this->Normalize($max, $nis, $pis)),$this->WGH_P);
			$avg_val = 1 - pow((1 - $this->Normalize($avg, $nis, $pis)),$this->WGH_P);
			$avg_min_val = 1 - pow((1 - $this->Normalize($avg_min, $nis, $pis)),$this->WGH_P);
			$avg_max_val = 1 - pow((1 - $this->Normalize($avg_max, $nis, $pis)),$this->WGH_P);
			$p1_val = 1 - pow((1 - $this->Normalize($p1, $nis, $pis)),$this->WGH_P);
			$p3_val = 1 - pow((1 - $this->Normalize($p3, $nis, $pis)),$this->WGH_P);
			$p5_val = 1 - pow((1 - $this->Normalize($p5, $nis, $pis)),$this->WGH_P);
			$p7_val = 1 - pow((1 - $this->Normalize($p7, $nis, $pis)),$this->WGH_P);
			
			$data = "[";
			$data .= "[".$min.",".$min_val."],";
			$data .= "[".$p1.",".$p1_val."],";
			$data .= "[".$avg_min.",".$avg_min_val."],";
			$data .= "[".$p3.",".$p3_val."],";
			$data .= "[".$avg.",".$avg_val."],";
			$data .= "[".$p5.",".$p5_val."],";
			$data .= "[".$avg_max.",".$avg_max_val."],";
			$data .= "[".$p7.",".$p7_val."],";
			$data .= "[".$max.",".$max_val."]";
			$data .= "]";
		}
		else
		{
			//jakie mamy pis i nis?
			$nis = $this->WGH_NIS;
			$pis = $this->WGH_PIS;
			
			$values = array_filter(explode(",", $this->WGH_VALUES));
			$data = "[";
			foreach ($values as $key=>$value)
			{
				$x = $key + 1;
				$y = 1 - pow((1 - $this->Normalize($x, $nis, $pis)),$this->WGH_P);
				$data .= $y.",";
			}
			$data .= "]";
		}
		
		return $data;
	}
	
	public function CalculateStuff($weight_sum, $criterion)
	{
		if ($this->WGH_VALUES == "")
		{
			//wyznaczenie pis i nis
			$this->WGH_PIS = $this->WGH_PREF == "min" ? $criterion->CRT_MIN : $criterion->CRT_MAX;
			$this->WGH_NIS = $this->WGH_PREF == "min" ? $criterion->CRT_MAX : $criterion->CRT_MIN;
			
			$middle_weight = $this->WGH_MIDLESCORE;
			$middle = 0.5;
		}
		else
		{
			//sredni ma byc powy¿ej, ale wtedy przy obliczaniu P, 
			//bedzie logarytm nie z 0.5 tylko np. 0.66 jeœli s¹ 4 etc.
			$middle = $this->MiddleValueNormalized;
			$this->WGH_PIS = 1;
			$this->WGH_NIS = $this->ValuesCount;
			$this->WGH_PREF = "n/a";
			$middle_weight = $this->WGH_MIDLESCORE;
		}
		
		//obliczenie wagi
		$this->WGH_WEIGHT = $this->WGH_IMPORTANCE / $weight_sum;
		//obliczenie P
		
		//var_dump($middle_weight);
		$middle_weight = 1 - ($middle_weight / 100);
		//var_dump($middle_weight);
		$this->WGH_P = log($middle_weight, $middle);
		//var_dump($this->WGH_P);
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
		$criteria->compare('WGH_VALUES',$this->WGH_VALUES,true);
		$criteria->compare('WGH_WEIGHT',$this->WGH_WEIGHT);
		$criteria->compare('WGH_PIS',$this->WGH_PIS);
		$criteria->compare('WGH_NIS',$this->WGH_NIS);
		$criteria->compare('WGH_P',$this->WGH_P);
		$criteria->compare('WGH_IMPORTANCE',$this->WGH_IMPORTANCE);
		$criteria->compare('WGH_MIDLESCORE',$this->WGH_MIDLESCORE);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}