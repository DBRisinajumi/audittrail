<?php

/**
 * This is the model class for table "audit_trail_page".
 *
 * The followings are the available columns in table 'audit_trail_page':
 * @property integer $id
 * @property string $action
 * @property string $model
 * @property string $stamp
 * @property string $user_id
 * @property string $model_id
 *
 * The followings are the available model relations:
 * @property AuditTrailRecord[] $auditTrailRecords
 */
class AuditTrailPage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AuditTrailPage the static model class
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
            if ( isset(Yii::app()->params['AuditTrail']) && isset(Yii::app()->params['AuditTrail']['pageTable']) )
		    return Yii::app()->params['AuditTrail']['pageTable'];
            else
		return 'audit_trail_page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('action, model, stamp, model_id', 'required'),
			array('action, model, user_id, model_id', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, action, model, stamp, user_id, model_id', 'safe', 'on'=>'search'),
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
			'auditTrailRecords' => array(self::HAS_MANY, 'AuditTrailRecord', 'page_id'),
                        'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('auditTrail', 'ID'),
			'action' => Yii::t('auditTrail', 'Action'),
			'model' => Yii::t('auditTrail', 'Model'),
			'stamp' => Yii::t('auditTrail', 'Stamp'),
			'user_id' => Yii::t('auditTrail', 'User'),
			'model_id' => Yii::t('auditTrail', 'Model ID'),
		);
	}
        
        function getParent(){
		$model_name = $this->model;
		return $model_name::model();
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
		$criteria->compare('action',$this->action,true);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('stamp',$this->stamp,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('model_id',$this->model_id,true);
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
        
	public function scopes() {
		return array(
			'recently' => array(
				'order' => ' t.stamp DESC ',
			),

		);
	}
}