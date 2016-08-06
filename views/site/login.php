<?php  

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MessageForm */
/* @var $form ActiveForm */

$this->title = 'Вход';
$this->params['breadcrumbs'][] =  [
    'label' => $this->title,
];
?>
<div class="site-login row">

    <?php $form = ActiveForm::begin([
            'options' => [
            'class' => 'form-horizontal col-md-6 col-md-offset-1',
            ],
        ]);?>
        <legend>Вход</legend>
        <?= $form->field($model, 'username')->textInput(['placeholder' => 'Введите admin']) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Введите 123456']) ?>
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-login -->
