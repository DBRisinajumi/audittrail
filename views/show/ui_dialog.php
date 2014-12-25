<?
//main table
$provider = $model->search(
                array(    
                    'pagination'=>array(
                        'pageSize'=>1000,
                    ),
                )
        );
$this->renderpartial('_table', array('model_name' => $model->model,'provider' => $provider));
//ref tables

if(!empty(Yii::app()->getModule("audittrail")->ref_models) && isset(Yii::app()->getModule("audittrail")->ref_models[$model_name])){

    foreach (Yii::app()->getModule('audittrail')->ref_models[$model_name] as $ref_model_name => $ref_field){
        
        if($ref_model_name == 'yii_t_category'){
            continue;
        }
        if($ref_model_name == 'yii_t_message'){
            continue;
        }
        
        $rm = new $ref_model_name;
        $rm_primary_key_field = $rm->tableSchema->primaryKey;
//        $rm_data = $rm->findAllByAttributes(array($ref_field => $model_id));
//        if(empty($rm_data)){
//            continue;
//        }
//        $rm_pk = array();
//        foreach ($rm_data as $rm_row){
//            $rm_pk[] = $rm_row->primaryKey;
//        }
        
        $criteria = new CDbCriteria;
        $criteria->distinct=true;
        $criteria->compare('model',$ref_model_name);
        $criteria->compare('field',$ref_field);
        $criteria->compare('new_value',$model_id);
        $criteria->compare('action','SET');


        $audit_trail = AuditTrail::model()->findAll($criteria);
        if(empty($audit_trail)){
            continue;
        }
        $rm_pk = array();
        foreach ($audit_trail as $at_row){
            $rm_pk[] = $at_row->model_id;
        }        
        
        $criteria = new CDbCriteria;
        $criteria->compare('model',$ref_model_name);
        $criteria->compare('model_id',$rm_pk);
        $criteria->addCondition("field !='".$rm_primary_key_field."'");        
        $criteria->addCondition("field !='".$ref_field."'");        
        $atrm_provider = new CActiveDataProvider('AuditTrail', array(
            'criteria' => $criteria,

        ));

        
        //perform only autoload
        class_exists($ref_model_name);

        //import module for translations
        //Yii::setPathOfAlias($ref_model_name.'Module', Yii::getPathOfAlias($ref_model_name).'/../');
        //Yii::import($ref_model_name.'Module.*');  
        //glob('./protected/modules/<module-name>/models/*.php')
//        $rm_module_path = realpath(Yii::getPathOfAlias($ref_model_name).'/../');
//        $rm_module_list = glob($rm_module_path.'/*Module.php');
//        $rm_module_name = basename($rm_module_list[0]); 
//        var_dump($rm_module_name);
        
        $this->renderpartial('_table', array('model_name' => $ref_model_name,'provider' => $atrm_provider));
    }
}