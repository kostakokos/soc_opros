<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>


<div class="start-form">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <h1 style="text-align: center;" >Заполните форму для начала опроса</h1>
            <?php $form = ActiveForm::begin([]); ?>

            <?= $form->field($model, 'socopros')->dropDownList($socialPoll, ['prompt' => 'Виберите соц. опрос']) ?>

            <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
              'mask' => '+8 (999) 999 99 99',
            ]) ?>

            <?= $form->field($model, 'email')->textInput() ?>

            <?= $form->field($model, 'old')->textInput() ?>

            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'famaly')->textInput() ?>

            <?= $form->field($model, 'patronymic')->textInput() ?>

            <?= $form->field($model, 'sex')->dropDownList($sex, ['prompt' => 'Виберите пол']) ?>
            <div class="form-group">
                <?= Html::submitButton('Начать опрос', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
