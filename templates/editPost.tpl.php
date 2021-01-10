<?php include 'base.tpl.php'?>
<script src="public/js/home.js"></script>

<div class="container container-home">
	<div class="row">
        <div class="col-12">
            <h1 class='text-center'>Editar entrada en el Blog</h1>
        </div>
        <div class="decoration-line"></div>
    </div>
    <div class="row container-news">
        <form action="/post/updatePost" method='POST'>
        <input type="hidden" name='id' value='<?= $post[0]['id'] ?>'>
        <div class="form-group">
            <label for="exampleFormControlInput1">Titulo</label>
            
            <input type="text" class="form-control" id="exampleFormControlInput1" name='title' placeholder="titulo para el post" value='<?= $post[0]['Title']?>'>
            
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Descripción corta</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name='short_description' placeholder='descripción corta' value='<?=$post[0]['Short_description']?>'> 
            
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripción</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name='description' rows="3"><?=$post[0]['description']?></textarea>
        </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Categoría</label>
    <select class="form-control" id="exampleFormControlSelect1" name='categoria'>
      <?php
      
        foreach($categories as $categoria){
            $class='';
            
            if($categoria['id'] == $post[0]['idCategorie']){
                $class='selected';
            }
            echo "<option value=".$categoria['id']. " " .$class .">".$categoria['name']."</option>";
        }

      ?>
    </select>
    <br>
    <input type="submit" value='Guardar'>
  </div>
  
  
        
        </form>
    </div>
</div>

<?php include 'footer.tpl.php'?>
