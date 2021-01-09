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
        <div class="col-12">
            <h1><?=$Post[0]['Title']?></h1>
        </div>
        <div class="col-12">
            <?=$Post[0] ["Short_description"]?>
        </div>
       
        <div class="col-12">
            <?=$Post[0]['description']?>
        </div>
        <div class="col-12">
            <?=$Post[0]['name']?>
        </div>
    </div>
    <div class="container-comments">
        <?php
        if($comments == null ){
            echo "No hay comentarios";
        }
        if(App\Session::get('user')== null || App\Session::get('user') == ''){
            echo "<p>Para poder hacer comentarios debes estar registrado</p>";
        }else{
            echo "<button> Comentar </button>";
        }
        ?>
    </div>
</div>

<?php include 'footer.tpl.php'?>
