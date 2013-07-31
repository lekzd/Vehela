<div class="Content">
    Здравствуйте, Глазки!<br/>
    <br/>
    Пройдите <a href="/index.php?module=main&controller=register&action=start">регистрацию</a>, чтобы начать использование Vehela
</div>


<?php

    $features = array();
    $features[] = 'test';

?>

<div class="projects">
    <h3>Что такое Vehela?</h3>
    <?php
        foreach($features as $key => $feature){
            require('_feature.tpl');
        }
    ?>
</div>
