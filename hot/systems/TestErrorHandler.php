<?php

class TestErrorHandler
{

    public function execute($errno, $errmsg, $file, $line)
    {
        echo "<div class='errorMessage'>";
        echo "<div class='title'>Произошла ошибка</div>";
        echo "<p>{$errmsg}<p/>";
        echo "<p>В файле: {$file}<p/>";
        echo "<p>На линии: {$line}<p/>";
        echo "</div>";
    }

}

?>
