<?php

if(App\Session::get('user')!= null || App\Session::get('user') != ''){
    header('Location:'.BASE);
}
?>
<?php include 'base.tpl.php'?>


<div class="container container-home">
	<div class="row">
        <div class="col-12">
            <h1 class='text-center'>Blog</h1>
        </div>
        <div class="decoration-line"></div>
    </div>
    <div class="row container-news">
     <p>Vista registro</p>
        <?php 
       
        if(App\Session::get('loginMessage')!=null){
           
            echo App\Session::get('loginMessage');
        }
       
        ?>
       <form action="<?=BASE?>user/register" method='POST'>
        <label>Correo electronico</label>
        <input type="email" name='correo' required>
        <label>Nombre</label>
        <input type="text" name='name' required>
        <label>Password</label>
        <input type="password" name='pass' required>
        <label>Repite Password</label>
        <input type="password" name='pass2'required>
        <input type="submit" value='login'>
       </form> 
    </div>
</div>

<?php include 'footer.tpl.php'?>