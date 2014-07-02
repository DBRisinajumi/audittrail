<?php
/**
 * create active record grid with full audit trail history
 * 
 */
class AudittrailHistory extends CWidget {
 
    /**
     * @var model 
     */
    public $model = FALSE;

    /**
     * grid table html id
     * @var string
     */
    public $id = 'audittrail_history_grid';
    
 
    public function run() {
        
        $m = new AuditTrail();
        $m->unsetAttributes();
        $m->model = get_class($this->model);
        $m->model_id = $this->model->getPrimaryKey();
        
        $this->renderpartial('history',
                array(
                    'model' => $m,
                    'id' => $this->id,
                ));
    }
 
}