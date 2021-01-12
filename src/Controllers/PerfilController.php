<?php

namespace App\Controllers;
use App\Controller;
use App\View;
use App\ExPDO;
use App\Request;
use App\Session;
use App\DB;


final class PerfilController extends Controller implements View,ExPDO{
    
    public function index(){
        if(Session::get('user') == null){
            header('Location:'.BASE);
        }
        $db = $this->getDB();
        $comments = '';
        $created =  $db->selectWhere('Users','email',Session::get('user'));
        if(Session::get('userRole')==1){
            $posts = $db->selectAll('Post');
            $comments = $db->selectAll('Comment');
            
        }else if($created[0]['id'] != null){
            $posts = $db->selectWhere('Post', 'created',$created[0]['id']);
        }
        
        $allCategories = $db->selectAll('Categories');
        $subcategories = $db->selectWhereNot('Categories','CategoriaPadre','');
        
        $dataView = [
            'title' => 'perfil',
            'Posts' => $posts,
            'categories' => $allCategories,
            'subcategorias' => $subcategories,
            'comments'  => $comments
        ];
        $this->render($dataView, 'perfil');
    }
    
}