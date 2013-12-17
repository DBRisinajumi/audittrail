<?
$this->widget('TbGridView', array(
    'dataProvider' => $model->search(),
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
        ),
        array(
            'name' => 'new_value',
        ),
        array(
            'name' => 'user_id',
            'value' => 'CHtml::value($data, \'user.username\')',
        ),
)));