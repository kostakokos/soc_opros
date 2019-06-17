<?php

use yii\helpers\Url;

$this->title = 'Соц. опрос';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Соц. опрос</h1>
        <p style="margin-top: 65px;" >
            <a class="btn btn-lg btn-success" href="<?= Url::to(['/site/start']) ?>">Начать опрос</a>
        </p>
    </div>
</div>
