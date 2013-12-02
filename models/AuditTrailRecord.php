<?php

/**
 * This is the model class for table "audit_trail_record".
 *
 * The followings are the available columns in table 'audit_trail_record':
 * @property integer $id
 * @property integer $page_id
 * @property string $old_value
 * @property string $new_value
 * @property string $field
 *
 * The followings are the available model relations:
 * @property AuditTrailPage $page
 */
class AuditTrailRecord extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AuditTrailRecord the static model class
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
            if ( isset(Yii::app()->params['AuditTrail']) && isset(Yii::app()->params['AuditTrail']['recordTable']) )
		    return Yii::app()->params['AuditTrail']['recordTable'];
            else
		return 'audit_trail_record';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_id', 'required'),
			array('page_id', 'numerical', 'integerOnly'=>true),
			array('field', 'length', 'max'=>255),
			array('old_value, new_value', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, page_id, old_value, new_value, field', 'safe', 'on'=>'search'),
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
			'page' => array(self::BELONGS_TO, 'AuditTrailPage', 'page_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'page_id' => 'Page',
			'old_value' => 'Old Value',
			'new_value' => 'New Value',
			'field' => 'Field',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($options = array())
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('page_id',$this->page_id);
		$criteria->compare('old_value',$this->old_value,true);
		$criteria->compare('new_value',$this->new_value,true);
		$criteria->compare('field',$this->field,true);
                $criteria->mergeWith($this->getDbCriteria());
		return new CActiveDataProvider(
			get_class($this),
			array_merge(
				array(
					'criteria'=>$criteria,
				),
				$options
			)
		);
	}
}