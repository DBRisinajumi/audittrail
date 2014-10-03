<h2 class="header blue lighter smaller">
<?php
$model = new $model_name;
echo CHtml::activeLabel($model ,$model_name);
?>
</h2>    
<?php
$this->widget('TbGridView', array(
    'dataProvider' => $provider,
    'id' => 'audit_trail_grid',
    'type' => 'bordered condensed',
    'template' => '{items}',
    'pager' => array(
        'class' => 'TbPager',
        'displayFirstAndLast' => false,
    ),
    'htmlOptions' => array('class'=>'nopadding'),
    'columns' => array(
        array(
            'name' => 'stamp',
        ),        
        array(
            'name' => 'field',
            'value' => 'CHtml::activeLabel('.$model_name.'::model()'.',$data->field)',
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