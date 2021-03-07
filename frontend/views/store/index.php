<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use app\models\Store;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Stores';
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'header'=>'<h2>List device</h2>',
    'options' => [
        'id'=>'contents',
    ]
]);
echo "<div id='modelContent'></div>";

Modal::end();
?>

<div class="store-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Store', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'filter' =>  Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'title',
                    'data' => ArrayHelper::map(Store::find()->asArray()->all(), 'title', 'title'),
                    'value' => 'title',
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'Select value'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'selectOnClose' => true,
                    ]
                ]),
                'value' => function($model){
                    return Html::a("$model->title",
                        ["store/?id=$model->id"],
                        [
                            'data-toggle'=>'modal',
                            'data-target'=> '#contents',
                            'class' => 'modal-store',
                            'data-id'=>"$model->id",
                        ]
                    );
                },
            ],
            [
                'attribute' => 'created_at',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php
$js = <<<JS
	$(document).ready(function () {
		
		$('.modal-store').click(function () {
			
			var buffer;
			$.get('/frontend/web/store/devices?id=' + $(this).data('id'), {'data': buffer}, function(buffer) {
				
				$('#contents').find('#modelContent').html(buffer);
				
			});
			
		});
		
	});
JS;
$this->registerJs($js);
?>