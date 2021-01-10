<?php

namespace App\Controllers;
use App\Controller;
use App\View;
use App\ExPDO;
use App\Request;
use App\Session;
use App\DB;

final class PostController extends Controller implements View,ExPDO{
    public function __construct(Request $request, Session $session){
        parent::__construct($request, $session);
    }
    public function detail(){
        $url = $_SERVER["REQUEST_URI"];
        $pos = strripos($url,'/');
        $id = substr($url,$pos+1,strlen($url));
        $db = $this->getDB();
        $post = $db->selectPost('Post','id',$id);
        $subcategories = $db->selectWhereNot('Categories','CategoriaPadre','');
        $allCategories = $db->selectAll('Categories');
        $comments = $db->selectWhere('Comment','idPost',$id,"id desc");
        
        $dataView = [
            'title' => 'detail',
            'Post' => $post,
            'categories' => $allCategories,
            'subcategorias' => $subcategories,
            'comments'  => $comments
        ];
        $this->render($dataView, 'detailPost');
    }
    public function create(){
        $db = $this->getDB();
        $subcategories = $db->selectWhereNot('Categories','CategoriaPadre','');
        
        $dataView = [
            'title' => 'create post',
            'categories' => $subcategories,
            
           
        ];
        $this->render($dataView, 'createPost');
    }
    public function savePost(){
        
        $db = $this->getDB();
        $title = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
        $short_description = filter_input(INPUT_POST,'short_description',FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST,'description',FILTER_SANITIZE_STRING);
        $categoria = filter_input(INPUT_POST,'categoria',FILTER_SANITIZE_STRING);
        $created =   $comments = $db->selectWhere('Users','email',Session::get('user'));
        
        $data = [
            'title' => $title,
            'short_description' => $short_description,
            'description'  => $description,
            'categoria'     => $categoria,
            'create'    => $created[0]['id']
        ];
        $db->createPost($data);
        header('Location:'.BASE);
    }
    public function delete(){
        $db = $this->getDB();
        $subcategories = $db->selectWhereNot('Categories','CategoriaPadre','');
        $allCategories = $db->selectAll('Categories');
        $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_STRING);
        $db->deletePost($id);

        header('Location:'.BASE.'perfil');
    }
    public function edit(){
        $db = $this->getDB();
        $subcategories = $db->selectWhereNot('Categories','CategoriaPadre','');
        $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_STRING);
        $post =  $db->selectWhere('Post','id',$id);
        
        $dataView = [
            'title' => 'create post',
            'categories' => $subcategories,
            'post'  => $post
           
        ];
        $this->render($dataView, 'editPost');
    }
    public function updatePost(){
        $db = $this->getDB();
        $title = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
        $short_description = filter_input(INPUT_POST,'short_description',FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_POST,'description',FILTER_SANITIZE_STRING);
        $categoria = filter_input(INPUT_POST,'categoria',FILTER_SANITIZE_STRING);
        $created =   $comments = $db->selectWhere('Users','email',Session::get('user'));
        $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_STRING);
        $data = [
            'title' => $title,
            'id'    => $id,
            'short_description' => $short_description,
            'description'  => $description,
            'categoria'     => $categoria,
            'create'    => $created[0]['id']
        ];
        $db->update($data);
        header('Location:'.BASE. 'perfil');
    }
}