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
        <?php 
        foreach($Posts as $post){
            echo '<div class="col-3 container-new">
                    <div class="row">
                        <div class="col-12"><h3 class="text-center">'.$post['Title'].'</h3></div>
                        <div class="col-12">'.$post['Short_description'].'</div>
                        <div class="col-12">Leer más</div>
                    </div>
                </div>';
        }
        ?>
    </div>
</div>

<?php include 'footer.tpl.php'?>
