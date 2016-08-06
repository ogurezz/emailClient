<?php  

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $model app\models\MessageForm */
/* @var $form ActiveForm */

$this->title = 'Входящая почта';
$this->params['breadcrumbs'][] =  [
    'label' => $this->title,
];
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="site-getmail row">
    <div class="col-md-12">
        <p>Почта получена с почтового ящика <strong><?= Yii::$app->params['adminEmail']?></strong> по протоколу IMAP.</p> 
        <strong>Реализовано:</strong>
        <ul>
            <li>Просмотр входящей почты</li>
            <li>Постраничная навигация</li>
            <li>Удаление выбранных писем</li>
        </ul>
        <?php $form = ActiveForm::begin([
            'id' => 'select_item',
            'action' => ['site/delmail'],
            'method' => 'get',
        ]);
        ?>
    <p class="text-right"><?= Html::submitButton('Удалить выбранные письма', ['class' => 'btn btn-danger']) ?></p>
    <table class='table table-striped table-bordered'>
        <thead>
            <tr>
                <th>Отправитель</th>
                <th>Тема письма</th>
                <th>Дата получения</th>
                <th><input type="checkbox" id="check_all"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($letter->id as $i): ?>
            <tr>
                <td><?= $letter->sender[$i].' &lt;'.$letter->from[$i].'&gt;'?></td>
                <td><?= $letter->subject[$i]?></td>
                <td><?= $letter->date[$i]?></td>
                <td><input type="checkbox" value="<?= $letter->id[$i]?>" name="id[]" form="select_item" class="checkbox" ></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php ActiveForm::end();?>
    </div>
    <div class="col-md-2">
        <?php if ($count_pages > 1): ?>
        <ul class="pagination">
            <li><span>Страница <?=$active_page?> из <?=$count_pages?></span></li>
        </ul>
        <?php endif ?>
    </div>
    <div class="col-md-10">
        <?=LinkPager::widget([
            'pagination' => $pagination,
            'firstPageLabel' => 'В начало',
            'lastPageLabel' => 'В конец',
            'prevPageLabel' => '&laquo;',
        ])?>
    </div>
    <div class="clearfix"></div>
</div><!-- site-getmail -->

