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
        $created =   $comments = $db->selectWhere('Users','email',Session::get('user'));
        $posts = $db->selectWhere('Post', 'created',$created[0]['id']);
        $allCategories = $db->selectAll('Categories');
        $subcategories = $db->selectWhereNot('Categories','CategoriaPadre','');
        
        $dataView = [
            'title' => 'perfil',
            'Posts' => $posts,
            'categories' => $allCategories,
            'subcategorias' => $subcategories
        ];
        $this->render($dataView, 'perfil');
    }
    
}