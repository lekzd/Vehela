<?php $Action = Registry::get('Router')->Action;?>
<?php $Breadcrumbs = Registry::get('Controller')->Breadcrumbs;?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{$Title}</title>

    <!-- Bootstrap core CSS -->
    <link href="/static/css/bootstrap/bootstrap.css" rel="stylesheet">
    <link href="/static/css/bootstrap/bootstrap-glyphicons.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/static/css/style.css" rel="stylesheet">
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><Vehela></Vehela></a>
        <div class="nav-collapse collapse">
            <ul class="nav navbar-nav">
<<<<<<< HEAD

                <li <?php if($Action=='hello') echo 'class="active"';?>><a href="/index.php">Главная</a></li>
                <li <?php if($Action=='about') echo 'class="active"';?>><a href="/index.php?module=static&controller=info&action=about">О Vehela</a></li>
                <li <?php if($Action=='team') echo 'class="active"';?>><a href="/index.php?module=static&controller=info&action=team">Команда</a></li>
                <li <?php if($Action=='debug') echo 'class="active"';?>><a href="/index.php?module=static&controller=info&action=debug"><?php echo '<#Debug#>'?></a></li>
=======
                <li class="active"><a href="/index.php">Главная</a></li>
                <li><a href="/index.php?module=static&controller=info&action=about">О Vehela</a></li>
                <li><a href="/index.php?module=static&controller=info&action=team">Команда</a></li>
                <li><a href="/index.php?module=static&controller=info&action=debug"><?php echo '<#Debug#>'?></a></li>
>>>>>>> 6ef0fb57bec5b80d1de07181673c64dc3a74a01a
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="content">


        <?php

            if(sizeof($Breadcrumbs)>0){

                echo '<ul class="PageName breadcrumb">';

                foreach($Breadcrumbs as $key=> $value){
                    if(!empty($value['url']))
                        echo '<li><a href="'.$value['url'].'">'.$value['title'].'</a></li>';
                    else
                        echo '<li class="active">'.$value['title'].'</li>';
                }

                echo '</ul>';

            }
        ?>



    {$Content}
</div><!-- /.content -->

<div class="footer">
    &copy Vehela. Нарисована ребятами из Vehela.team
</div>

<script src="/static/js/jquery-1.4.2.min.js"></script>
<script src="/static/js/bootstrap/bootstrap.min.js"></script>
</body>
</html>