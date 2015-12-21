<?php

class AudittrailColumnTbButton extends TbButtonColumn {


	public $auditButtonLabel ;
	public $auditButtonImageUrl;
	public $auditButtonUrl;
	public $auditButtonOptions=['data-toggle'=>'tooltip'];
    public $auditButtonIcon = 'icon-info-sign';
    
   
    protected function initDefaultButtons()
	{
        $this->template = '{audit} {view} {update} {delete}';
        parent::initDefaultButtons();
        
        if($this->auditButtonLabel === null)
            $this->auditButtonLabel = Yii::t("AudittrailModule.main", "Auditrail");
        
        
        $button=array(
            'label'=>$this->auditButtonLabel,
            'url'=>$this->auditButtonUrl,
            'imageUrl'=>$this->auditButtonImageUrl,
            'options'=>$this->auditButtonOptions,
            'icon'=>$this->auditButtonIcon,
        );
        if(isset($this->buttons['audit']))
            $this->buttons['audit']=array_merge($button,$this->buttons['audit']);
        else
            $this->buttons['audit']=$button;        
        
    }    
}
