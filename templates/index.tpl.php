<?php include 'base.tpl.php'?>
<script src="<?=BASE?>public/js/home.js"></script>

<div class="container container-home">
	<div class="row">
        <div class="col-12">
            <h1 class='text-center'>Blog</h1>
        </div>
        <div class="decoration-line"></div>
    </div>
    <div class="row container-news justyfy-content-between">
        <?php 
        foreach($Posts as $post){
            echo '<div class="col-4 container-new p-0 m-0 mb-5">
            <a href = "'.BASE.'post/detail/'.$post['id'].'"><div class="row m-0 p-0 h-100">
                        <div class="col-12" style="min-height: 70px;"><h3 class="text-center">'.$post['Title'].'</h3></div>
                        <hr>  
                        <div class="col-12 text-center py-2">'.$post['Short_description'].'</div>
                        <div class="col-12 text-end">Leer más</div>
                    </div></a>
                </div>';
        }
        ?>
    </div>
</div>

<?php include 'footer.tpl.php'?>
