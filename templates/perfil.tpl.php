

<?php include 'base.tpl.php'?>
<script src="public/js/home.js"></script>

<div class="container container-home">
	<div class="row">
        <div class="col-12">
        <h1 class='text-center'>Perfil</h1>
        <div class="decoration-line"></div>
        <?php 
        if(App\Session::get('userRole')==2){
            echo "<h3>Tus Aportaciones al Blog:</h3>";
        }else{
            echo "<h3> Posts Subidos</h3>";
        }
      ?>
        </div>
        <hr>
    </div>
    <div class="row container-news">
        <?php 
        foreach($Posts as $post){
            echo '<div class="col-3 container-new">
            <div class="row">
            <div class="col-12">
                <a href = "'.BASE.'post/detail/'.$post['id'].'"><div class="row">
                        <div class="col-12"><h3 class="text-center">'.$post['Title'].'</h3></div>
                        <div class="col-12">'.$post['Short_description'].'</div>
                        <div class="col-12">Leer más</div>
                    </div>
                </a>
            </div>
            <div class="delete col-6 btn btn-danger" id="'.$post['id'].'">Eliminar</div>
            <div class="edit col-6 btn btn-info" id="'.$post['id'].'">Modificar</div>
            </div>
            </div>
            
                <form class="d-none" action="'.BASE.'post/delete" method="POST" id="delete-form'.$post['id'].'">
                    <input type="hidden" name="id" value='.$post['id'].'>
                </form>
        
        
            <form class="d-none" action="'.BASE.'post/edit" method="POST" id="edit-form'.$post['id'].'">
                <input type="hidden" name="id" value='.$post['id'].'>
            </form>';            
        }
     ?>  
    </div>
   
    <?php 
        if(App\Session::get('userRole')==1){
    ?>
             <div class="container-coments">
           
      
            <h3> Comentarios de los Usuarios</h3>
            
      <?php
     foreach($comments as $comment){
        echo '
            <div class="row">
                <div class="col-12">'.$comment['created'].'</div>
                <div class="col-12">'.$comment['title'].'</div>
                <div class="col-12">'.$comment['description'].'</div>
                <div class="col-12">'.$comment['created_at'].'</div>
                <div class="delete-comment col-6 btn btn-danger" id="'.$comment['id'].'">Eliminar</div>
            </div>
            <hr>
            ';
            echo '<form class="d-none" action="'.BASE.'comment/delete" method="POST" id="delete-comment'.$comment['id'].'">
            <input type="hidden" name="id" value='.$comment['id'].'>
        </form>';
     }
     
    }
      ?>
      
    </div>
</div>

<?php include 'footer.tpl.php'?>
<script>
    $('.delete').click(function(){
        let id = $(this).attr('id');
        $('#delete-form'+id).submit();
    })
    $('.delete-comment').click(function(){
        let id = $(this).attr('id');
       
        $('#delete-comment'+id).submit();
    })
    $('.edit').click(function(){
        let id = $(this).attr('id');
        $('#edit-form'+id).submit();
    })
</script>
