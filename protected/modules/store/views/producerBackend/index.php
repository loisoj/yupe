<?php
$this->breadcrumbs = array(
    Yii::t('StoreModule.producer', 'Производители') => array('/store/producerBackend/index'),
    Yii::t('StoreModule.producer', 'Управление'),
);

$this->pageTitle = Yii::t('StoreModule.producer', 'Производители - управление');

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => Yii::t('StoreModule.producer', 'Управление производителями'), 'url' => array('/store/producerBackend/index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => Yii::t('StoreModule.producer', 'Добавить производителя'), 'url' => array('/store/producerBackend/create')),
);
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('StoreModule.producer', 'Производители'); ?>
        <small><?php echo Yii::t('StoreModule.producer', 'управление'); ?></small>
    </h1>
</div>

<?php
$this->widget(
    'yupe\widgets\CustomGridView',
    array(
        'id' => 'producer-grid',
        'type' => 'condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array(
                'name' => 'image',
                'type' => 'raw',
                'value' => 'CHtml::image($data->getImageUrl(50), "", array("width" => 50, "height" => 50, "class" => "img-thumbnail"))',
                'filter' => false
            ),
            array(
                'name' => 'name_short',
                'type' => 'raw',
                'value' => 'CHtml::link($data->name_short, array("/store/producerBackend/update", "id" => $data->id))',
            ),
            array(
                'name' => 'name',
                'type' => 'raw',
                'value' => 'CHtml::link($data->name, array("/store/producerBackend/update", "id" => $data->id))',
            ),
            array(
                'class'    => 'bootstrap.widgets.TbEditableColumn',
                'name'     => 'slug',
                'editable' => array(
                    'url'    => $this->createUrl('/store/producerBackend/inline'),
                    'mode'   => 'inline',
                    'params' => array(
                        Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken
                    )
                ),
                'filter'   => CHtml::activeTextField($model, 'slug', array('class' => 'form-control')),
            ),
            array(
                'class'   => 'yupe\widgets\EditableStatusColumn',
                'name'    => 'status',
                'url'     => $this->createUrl('/store/producerBackend/inline'),
                'source'  => $model->getStatusList(),
                'options' => [
                    Producer::STATUS_ACTIVE => ['class' => 'label-success'],
                    Producer::STATUS_NOT_ACTIVE => ['class' => 'label-info'],
                    Producer::STATUS_ZERO => ['class' => 'label-default'],
                ],
            ),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ),
        ),
    )
); ?>