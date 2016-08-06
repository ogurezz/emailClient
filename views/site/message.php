<?php  

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MessageForm */
/* @var $form ActiveForm */

$this->title = 'Написать письмо';
$this->params['breadcrumbs'][] =  [
    'label' => $this->title,
];
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="site-message row">
    <div class="col-md-12">
        <p>Письмо будет отправлено с почтового ящика <strong><?= Yii::$app->params['adminEmail']?></strong> от имени <strong><?= Yii::$app->user->identity['username']?></strong> по протоколу SMTP</p>
    </div>
    <?php $form = ActiveForm::begin([
            'options' => [
            'class' => 'form-horizontal col-md-6 col-md-offset-1',
            ],
        ]);?>
        <?= $form->field($model, 'email')
            ->textInput([
                'maxlength'   => 32,
                'placeholder' => 'Введите email получателя',
                'class'       => 'form-control input-md',
            ]); ?>
        <?= $form->field($model, 'subject') ?>
        <?= $form->field($model, 'body')
            ->textarea([
                'placeholder' => 'Введите Ваше сообщение',
                'rows'         => 6,
                'class'       => 'form-control',
            ]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Отменить', [
            'class' => 'btn btn-danger',
            'style' => 'margin:5px',
        ])?>
        </div>
        </div>

    <?php ActiveForm::end(); ?>

</div><!-- site-message -->
