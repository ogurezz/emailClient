<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LettersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Исходящая почта';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="letters-index">

    <p>Почта, отправленная с почтового ящика <strong><?= Yii::$app->params['adminEmail']?></strong> по протоколу SMTP.</p> 
        <strong>Реализовано:</strong>
        <ul>
            <li>Просмотр отправленной почты</li>
            <li>Постраничная навигация</li>
            <li>Поиск (фильтрация) писем по <strong>Адресу получателя</strong>, <strong>Теме</strong>, <strong>Тексту</strong>, <strong>Дате отправки</strong></li>
            <li>Сортировка по убыванию/возрастанию писем по <strong>Адресу получателя</strong>, <strong>Теме</strong>, <strong>Тексту</strong>, <strong>Дате отправки</strong></li>
            <li>Детальный просмотр письма</li>
            <li>Удаление писем из архива</li>
        </ul>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>"Показаны элементы <strong>{begin}-{end}</strong> из <strong>{totalCount}</strong>",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'email',
            'subject',
            'body:ntext',
            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'dd.MM.Y HH:mm:ss'],
            ],
            //'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
            'header'=>'Действия', 
            'headerOptions' => ['width' => '80'],
            'contentOptions' =>['style'=>'text-align:center;'],
            'template' => '  {view} {delete}  ',],
        ],
    ]); ?>
</div>
