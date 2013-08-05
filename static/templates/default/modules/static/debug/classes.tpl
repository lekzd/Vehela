<h1>Debug.Classes.Feature</h1>

<<<<<<< HEAD

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
=======
<p>RequestMethod: {$RequestMethod}</p>

<?php

    var_dump ('{$Test}');

?>

<br/>
<br/>

<form action="" method="post">
    <p>
        <input name="ClassName" type="text" placeholder="$ClassName"/>
    </p>
    <input type="submit" class="btn" value="Check">
</form>
>>>>>>> 6ef0fb57bec5b80d1de07181673c64dc3a74a01a
