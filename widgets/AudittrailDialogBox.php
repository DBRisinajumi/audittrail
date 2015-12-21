<?php

class AudittrailDialogBox extends CWidget {
    public function run(){
        $this->beginWidget('vendor.uldisn.ace.widgets.CJuiAceDialog', array(
            'id' => 'audittrail_dialog_box',
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

        Yii::app()->clientScript->registerScript('for_display_audittrail', 
               '
               $(document ).on("click","a[href*=\'audittrail/show/fancybox\']",function(event) {
                   event.preventDefault();
                   var ui_dialog_ajax_url = $(this).attr("href");
                   $("#audittrail_dialog_box").html("");
                   $("#audittrail_dialog_box").load(ui_dialog_ajax_url).dialog("open"); 
                   return false;
              })   
               '
        );
        
    }
}