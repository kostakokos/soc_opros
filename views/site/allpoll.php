<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
    
    $this->title = 'Все опросы пользователей'
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
                               'label' => 'ID',
                               'attribute' => 'id',
                               'options' => ['width' => '50']
                            ],
                            [
                               'label' => 'Номер соц. опроса',
                                'value' => function($data) {
                                    return $data->socialPoll->name;
                                }
                            ],
                            'email',
                            'years_old',
                            'phone',
                            [
                                'label' => 'Данные пользователя',
                                'content' => function($data) {
                                    $pData = $data->personalDatas;
                                    if ($pData) {
                                        return "<p>{$pData->name}</p><p>{$pData->famaly}</p><p>{$pData->patronymic}</p>";
                                    }
                                    return "---";
                                }
                            ],
                            [
                                'label' => 'Пол',
                                'attribute' => 'sex_id',
                                'value' => function($data) {
                                    return $data->sex->name;
                                }
                                
                            ],
                            [
                               'label' => 'Ответы',
                               'options' => ['width' => '50'],
                               'content' => function($data){
                                    $url = Url::to(['/site/answers', 'user' => $data->id]);
                                    return "<a href='{$url}'>Ответы</a>";
                                }
                            ],
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>