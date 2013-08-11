<div class="starter-template">
    <h1><span class="glyphicon glyphicon-comment"></span> Привет, Мир!</h1>
    <p class="lead">Vehela Рада приветствовать Вас.</p>
</div>

Добро пожаловать,
<?php
    $User = Registry::get('Controller')->Objects['Var'];
    echo $User['login'];
?>!
