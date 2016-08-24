<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <? foreach ($dataProvider->models as $model):?>
    	<h2><a href="/?r=site/article&id=<?= $model->id?>"><?= $model->title?></a></h2>
    <?  endforeach;?>

</div>
