<?php

class AudittrailViewTbButton extends TbButton {

    public $model_name;
    public $model_id;
    public $type = self::TYPE_INFO;
    public $size = self::SIZE_LARGE;
    public $icon = "icon-info-sign";
    public $htmlOptions = array(
        "class" => "search-button",
        "data-toggle" => "tooltip",
            //"title" => "Audit Trail",
    );
    
    private $dialog_id;

    public function init() {

        if (!isset($this->htmlOptions['title'])) {
            $this->htmlOptions['title'] = Yii::t("AudittrailModule.main", "Audit Trail");
        }

        $this->url = array(
            '/audittrail/show/uiDialogBox',
            'model_name' => $this->model_name,
            'model_id' => $this->model_id,
        );
        
        $this->id = 'audittrail_button_'.$this->model_name.'_'.$this->model_id;
        $this->dialog_id = 'audittrail_dialog_'.$this->model_name.'_'.$this->model_id;
        $this->dialogWidget();
        $this->registerScripts();
        parent::init();
    }

    public function dialogWidget() {
        $this->beginWidget('vendor.uldisn.ace.widgets.CJuiAceDialog', array(
            'id' => $this->dialog_id,
            'title' => Yii::t('AudittrailModule.main','Audit Trail records'),
            'title_icon' => 'icon-info-sign',
            'options' => array(
                'resizable' => true,
                'width' => 'auto',
                'height' => 'auto',
                'modal' => true,
                'autoOpen' => false,
            ),
        ));

        $this->endWidget('vendor.uldisn.ace.widgets.CJuiAceDialog');
    }

    protected function registerScripts() {
        Yii::app()->clientScript->registerScript($this->id, 
        '
        $(document ).on("click","#'.$this->id.'",function(event) {
            event.preventDefault();
            var ui_dialog_ajax_url = $(this).attr("href");
            $("#'.$this->dialog_id.'").html("");
            $("#'.$this->dialog_id.'").load(ui_dialog_ajax_url).dialog("open"); 
            return false;
       })   
        '
        );
    }

//    /**
//     * Renders the close tag of the dialog.
//     */
//    public function run() {
//        echo CHtml::closeTag($this->tagName);
//    }
}
