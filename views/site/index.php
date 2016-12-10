<?php

/* @var $this yii\web\View */

$this->title = 'UrlCompressor';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 text-center">
                <h2 class="text-center">URL-компрессор</h2>
                <input type="url" id="url" class="form-control" placeholder="Скопируйте сюда URL для сжатия" pattern="/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/">
                <button class="btn btn-primary btn-lg text-center" id="start" style="margin-top: 1em">Сжать</button>
                <hr>
                <div id="result" class="hidden">
                    <label for="compressed">Результат:</label>
                    <input type="url" id="compressed" class="form-control">
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
</div>
