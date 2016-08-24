<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = $articleProvider->query->title;
?>
<div class="article-index">
    	<h2><?= $articleProvider->query->title?></h2>
		<p><?= Html::encode($articleProvider->query->body)?></p>
</div>

<div class="article-index js-comments">
    	<h2>Комментарии</h2>
    	<ul>
    		<?  if($commentsProvidervider->models):?>
        		<?  foreach ($commentsProvidervider->models as $comment):?>
            		<li style="padding-left: <?= $comment->getLevel()*40?>px;">
            		   	<b><?= $comment->name?></b> | <?= $comment->email?> | 
            		   	<i><?= $comment->created_at?></i>
            		    <p><?= $comment->getFormatedText()?></p>
            		    <p><a href="#" 
            		    		class="js-respond" 
            		    		id="<?= $comment->id?>" 
            		    		data-path="<?= $comment->path?>"
            		    		data-level="<?= $comment->getLevel()?>"	
            		    	>Ответить</a></p>
            			<hr>
            		</li>
        		<? endforeach;?>
    		<? endif;?>
    			
    		
    	</ul>
    	<p><a href="#" class="js-respond" id="0" data-path="" data-level="-1">Написать комментарий</a></p>
</div>

<div style="display: none;" class="js-form-holder">

	<?php  $form = ActiveForm::begin([
		'id' => 'js-form',
		'ajaxDataType' => 'json',
		'ajaxParam' => 'ajax',
	]); ?>

	<?= Html::activeHiddenInput($model, 'article_id', ['value' => $articleProvider->query->id]) ?>
	<?= Html::activeHiddenInput($model, 'parent_id', ['value' => 0]) ?>
	<?= Html::activeHiddenInput($model, 'path', ['value' => '']) ?>
	<?= Html::activeHiddenInput($model, 'level', ['value' => 0 ]) ?>

	<?= $form->field($model, 'name') ?>
	<?= $form->field($model, 'email') ?>
	<?= $form->field($model, 'text') ?>
	<?= $form->field($model, 'verifyCode')->widget(Captcha::className()) ?>
	<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']);?>
	<p class="js-error alert alert-danger" style="display: none;"></p>
	<?php ActiveForm::end();  ?>
	
</div>



