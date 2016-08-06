<?php  

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MessageForm */
/* @var $form ActiveForm */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] =  [
    'label' => $this->title,
];
?>
<div class="site-reg row">

    <?php $form = ActiveForm::begin([
            'options' => [
            'class' => 'form-horizontal col-md-6 col-md-offset-1',
            ],
        ]);?>
        <legend>Регистрация</legend>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-reg -->
