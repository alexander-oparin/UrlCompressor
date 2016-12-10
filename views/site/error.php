<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = 'Страница не существует';
?>
<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <p>
            Ой! Раз вы здесь оказались, значит вам подсунули неправильную ссылку...
            <br>
            Перейти на <?= Html::a('главную страницу', '/') ?>
        </p>
    </div>
</div>
