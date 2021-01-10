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
      
            <h1 class='title-stn'><?=$Post[0]['Title']?></h1>
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
        
        if(App\Session::get('user')== null || App\Session::get('user') == ''){
            echo "<p>Para poder hacer comentarios debes estar registrado</p>";
        }else{
            
            echo "
            <form action='".BASE."comment/create' method='POST'>
            <div class='form-group'>
                <input type='text' name='title' placeholder='titulo'>
            </div>
            <div class='form-group'>
            <textarea name='comment'></textarea>
            </div>
            <div class='form-group'>
            <input type='hidden' value='".$Post[0]["id"]."' name='idPost'>
            <input type='submit' value='comentar'> 
            </div>
            </form>";

        }
        if($comments == null ){
            echo "No hay comentarios";
        }else{
            foreach($comments as $comment){
                echo '
                <div class="row">
                    <div class="col-12">'.$comment['created'].'</div>
                    <div class="col-12">'.$comment['title'].'</div>
                    <div class="col-12">'.$comment['description'].'</div>
                    <div class="col-12">'.$comment['created_at'].'</div>
                
                </div>
                <hr>
                ';
            }
            
        }
        ?>
    </div>
</div>

<?php include 'footer.tpl.php'?>
