<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form ActiveForm */
?>
<div class="article">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'body') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'title') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article -->
