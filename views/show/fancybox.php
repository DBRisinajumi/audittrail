<h2>
    <i class="icon-info-sign"></i>
    <?=Yii::t('AudittrailModule.main','Auditrail records')?>
</h2>
<?
$this->widget('TbGridView', array(
    'dataProvider' => $model->search(
                array(    
                    'pagination'=>array(
                        'pageSize'=>1000,
                    ),
                )
            ),
    'id' => 'audit_trail_grid',
    'type' => 'bordered condensed',
    'template' => '{items}',
    'pager' => array(
        'class' => 'TbPager',
        'displayFirstAndLast' => false,
    ),
    'columns' => array(
        array(
            'name' => 'stamp',
        ),        
        array(
            'name' => 'field',
            'value' => 'CHtml::activeLabel('.$model->model.'::model()'.',$data->field)',
            'type'=>'raw',
        ),
        array(
            'name' => 'old_value',
            'value' => 'Yii::app()->getModule("audittrail")->getRefFieldValue($data->field,$data->old_value)',
        ),
        array(
            'name' => 'new_value',
            'value' => 'Yii::app()->getModule("audittrail")->getRefFieldValue($data->field,$data->new_value)',
        ),
        array(
            'name' => 'user_id',
            'value' => 'CHtml::value($data, \'user.username\')',
        ),
)));