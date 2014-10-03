<?php

class AudittrailModule extends CWebModule
{
    /**
     * define sql selects for geting referenc field values
     * @var array 
     */
    public $ref_field_sql = array();
    public $ref_models = array();
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'audittrail.components.*',
		));

	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
    
    
    /**
     * get ref field value
     * @param char $field field name
     * @param int $id field value
     * @return char
     */
    public static function getRefFieldValue($field,$id){
        
        if(empty($id)){
            return $id;
        }
        $ref_field_sql = Yii::app()->getModule('audittrail')->ref_field_sql;
        if(!isset($ref_field_sql[$field])){
            return $id;
        }
        $sql = str_replace('#id#', $id, $ref_field_sql[$field]);
        $value = Yii::app()->db->createCommand($sql)->queryScalar();
        if($value === FALSE){
            return $id;
        }
        
        return $value;
    }
}
