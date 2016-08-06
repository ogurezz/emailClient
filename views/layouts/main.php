<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\AlertWidget;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
        <title><?= Yii::$app->name ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <?= Html::csrfMetaTags() ?>
        <?= $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width,initial-scale=1']); ?>
        <?= $this->head() ?>
    </head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => ['/site/index'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
        $menuItems = [];
    if (!Yii::$app->user->isGuest):
        $menuItems[] = [
            'label' => 'Входящая почта',
            'url'   => ['/site/getmail']
        ];
        $menuItems[] = [
            'label' => 'Исходящая почта',
            'url'   => ['/letters/index']
        ];
        $menuItems[] = [
            'label' => 'Написать письмо',
            'url'   => ['/site/message']
        ];
        $menuItems[] =  [
            'label' => 'Выйти ('.Yii::$app->user->identity['username'].')',
            'url'   => ['/site/logout'],
            'linkOptions' =>['data-method' => 'post']
        ];
    else:
        $menuItems[] = [
            'label' => 'Регистрация',
            'url'   => ['/site/reg']
        ];
        $menuItems[] = [
            'label' => 'Войти',
            'url'   => ['/site/login']
        ];
    endif;


    echo Nav::widget([
        'items' => $menuItems,
        'encodeLabels' => false,
        'options' => ['class' =>'navbar-nav navbar-right'], 
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
                    'homeLink' => ['label' => 'Главная', 'url' => '/site/index'],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
        <?= AlertWidget::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Савченко Юрий <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
<div class="scroll-top-wrapper">
    <span class="scroll-top-inner">
    <span class="glyphicon glyphicon-chevron-up"></span>
    </span>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
