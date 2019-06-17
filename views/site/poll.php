<?php 
	
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\Alert;

?>
<div class="poll-form">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?= Alert::widget() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <h1 style="text-align: center;" >Вопрос № <?=$question->id?></h1>
            <p style="margin-bottom: 40px;margin-top: 40px" >
            	<?=$question->description?>
            </p>
            <?php $form = ActiveForm::begin([]); ?>

			<?= $form->field($model, 'answers_id')->dropDownList($answers, ['prompt' => 'Виберите ответ']) ?>

			<?= $form->field($model, 'questions_id')->hiddenInput(['value' => $question->id])->label(false) ?>

			<?= $form->field($model, 'user_id')->hiddenInput(['value' => $user_pull])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Ответить', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>