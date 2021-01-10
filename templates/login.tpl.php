<?php include 'base.tpl.php'?>
<script src="public/js/home.js"></script>

<div class="container container-home">
	<div class="row">
        <div class="col-12">
            <h1 class='text-center'>Blog</h1>
        </div>
        <div class="decoration-line"></div>
    </div>
    <div class="row container-news">
     <p>Vista login</p>
        <?php if(App\Session::get('loginMessage')!=null){
            echo App\Session::get('loginMessage');

        }
        ?>
       <form action="<?=BASE?>user/login" method='POST'>
        <label>Correo electronico</label>
        <input type="email" name='correo'>
        <label>Password</label>
        <input type="password" name='pass'>
        <input type="submit" value='login'>
       </form> 
    </div>
</div>

<?php include 'footer.tpl.php'?>