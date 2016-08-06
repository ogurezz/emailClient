<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">
    <div class="jumbotron">
        <?php if (Yii::$app->user->isGuest): ?>
        <h1>Добрый день</h1>
        <p class="lead">Вашему вниманию представляется реализация тестового задания "Мини почтовый клиент". Выполнены основное и дополнительное задание.
              Чтобы войти в приложение - <a href="<?= Url::to(['/site/reg']);?>">зарегистрируйтесь</a> или используйте для <a href="<?= Url::to(['/site/reg']);?>">входа</a> логин admin и пароль 123456
         <?php else: ?>
         <h1>Добро пожаловать</h1>
        <p class="lead">Воспользуйтесь панелью навигации<p>
            <ul>
                <li><a href="<?= Url::to(['/site/getmail']);?>">Входящая почта</a> - для получения почты  с почтового ящика <strong><?= Yii::$app->params['adminEmail']?></strong> по протоколу IMAP.</li>
                <li><a href="<?= Url::to(['/letter/index']);?>">Исходящая почта</a> - для просмотра почты, отправленной из данного приложения с почтового ящика <strong><?= Yii::$app->params['adminEmail']?></strong> по протоколу SMTP.</li>
                <li><a href="<?= Url::to(['/site/message']);?>">Написать письмо</a> - для отправки письма из приложения по указанному Вами адресу</li>
            </ul>
         <?php endif ?>
    </div>
</div>
