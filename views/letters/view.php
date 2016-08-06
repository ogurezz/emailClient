<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Letters */

$this->title = 'Подробно';
$this->params['breadcrumbs'][] = ['label' => 'Исходящая почта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'email',
            'subject',
            'body:ntext',
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'dd.MM.Y HH:mm:ss'],
            ],
            //'updated_at',
        ],
    ]) ?>

</div>
