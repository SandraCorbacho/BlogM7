<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE ?>public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,900&display=swap" rel="stylesheet">   
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src='<?= BASE ?>public/js/general.js'></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<header>
<nav>
<div class="row justify-content-between p-0 m-0">
    <div class="col-1"><a href='<?=BASE?>'><img class='w-100' src="<?= BASE ?>public/img/logo.png" alt=""></a></div>
    <?php 
        
        foreach($categories as $key => $categoria){
            if($categoria['CategoriaPadre'] == null){
                echo "<div class='col text-center'>
                
                    <div class='menu col-12' id='menu".$key."' >".$categoria['name']."</div>";
                
                       
                    echo "<div class='submenu col-12' id ='submenu".$key."'>";
            foreach($subcategorias as $subcategoria){
                
                if($subcategoria['CategoriaPadre'] == $categoria['id']){
                    echo "<a href='".BASE."categoria/detailCategoria/".$subcategoria['id']."'><p>".$subcategoria['name']."</p></a>";
                }
            }
                    echo "</div>";
            };
            
                echo "</div>";
        }
        echo '<div class="row justify-content-end container-login">';
            if(App\Session::get('user')== null || App\Session::get('user') == ''){
                echo "<div class='col-4 text-center'><a href='".BASE."user'><img class='logo' src='".BASE."public/img/user.svg'></a></div>";
                echo "<div class='col-4 text-center'><a href='".BASE."user/register'><img style='width:27px' class='logo' src='".BASE."public/img/register.svg'></a></div>";
            }else{
                echo "<div class='col-4 text-center'><a href='".BASE."perfil'><img class='logo' src='".BASE."public/img/user.svg'></a></div>";
                echo "<div class='col-4 text-center'><a href='".BASE."post/create'><img class='logo' src='".BASE."public/img/plus.svg'> Post</a></div>";
                echo "<div class='col-4 text-center'><a href='".BASE."logout'><img class='logo' src='".BASE."public/img/logout.svg'></a></div>";
            }
        echo '</div>';
        
    ?>
    </div>
</nav>

</header>   