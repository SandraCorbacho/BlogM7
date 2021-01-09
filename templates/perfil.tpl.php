

<?php include 'base.tpl.php'?>
<script src="public/js/home.js"></script>

<div class="container container-home">
	<div class="row">
        <div class="col-12">
        <h1 class='text-center'>Perfil</h1>
        <hr>
        <h3>Tus Aportaciones al Blog:</h3>
        </div>
        <div class="decoration-line"></div>
    </div>
    <div class="row container-news">
        <?php 
        foreach($Posts as $post){
            echo '<div class="col-3 container-new">
            <div class="row">
            <div class="col-12">
                <a href = "/post/detail/'.$post['id'].'"><div class="row">
                        <div class="col-12"><h3 class="text-center">'.$post['Title'].'</h3></div>
                        <div class="col-12">'.$post['Short_description'].'</div>
                        <div class="col-12">Leer más</div>
                    </div>
                </a>
            </div>
            <div id="delete" class="col-6 btn btn-danger">Eliminar</div>
            <div class="col-6 btn btn-info">Modificar</div>
            </div>
            </div>';

        }
        ?>
        <div>
            <form action="/post/delete" method='POST' id='delete-form'>
                <input type="hidden" name='id' value='<?=$post['id']?>'>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.tpl.php'?>
<script>
    $('#delete').click(function(){
        $('#delete-form').submit();
    })
</script>
