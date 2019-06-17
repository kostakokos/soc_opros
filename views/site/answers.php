<?php 

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
    
$this->title = 'Ответы';
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body-table">
                    <div class="card-title">
                        <h1 class="text-center title-2"><?=$this->title?></h1>
                    </div>
                    <hr>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'tableOptions' => [
                            'class' => 'table table-borderless table-striped table-earning'
                        ],
                        'columns' => [
                            [
                                'label' => 'Ответ',
                                'attribute' => 'questions_id',
                                'content' => function($data) {
                                    return $data->questions->description;
                                }
                            ],
                            [
                                'label' => 'Вопрос',
                                'attribute' => 'answers_id',
                                'content' => function($data) {
                                    return $data->answers->name;
                                }
                            ],
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>