<h1>Debug.Classes.Feature</h1>


<form action="" method="post">
    <p>
        <input name="ClassName" type="text" placeholder="#ClassName"/>
    </p>
    <input type="submit" class="btn" value="Check">
</form>


<br/>

<?php

    if(!empty(Registry::get('Controller')->Objects['methods'])){

        $Objects = Registry::get('Controller')->Objects['methods'];
		
        foreach($Objects as $key => $name){
            echo "public function <b>{$name}</b>()<br/>{} <br/><hr/>";
        }

    }


?>