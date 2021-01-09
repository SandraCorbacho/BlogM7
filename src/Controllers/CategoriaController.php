<?php

namespace App\Controllers;
use App\Controller;
use App\View;
use App\ExPDO;
use App\Request;
use App\Session;
use App\DB;

final class CategoriaController extends Controller implements View,ExPDO{
    public function __construct(Request $request, Session $session){
        parent::__construct($request, $session);
    }
    
   function detailCategoria(){
    
    $url = $_SERVER["REQUEST_URI"];
    $pos = strripos($url,'/');
    $idCategoria = substr($url,$pos+1,strlen($url));
    $db = $this->getDB();
    $posts = $db->selectWhere('Post','idCategorie',$idCategoria);
    
    $subcategories = $db->selectWhereNot('Categories','CategoriaPadre','');
    $allCategories = $db->selectAll('Categories');
    $dataView = [
        'title' => 'home',
        'Posts' => $posts,
        'categories' => $allCategories,
        'subcategorias' => $subcategories
    ];
    $this->render($dataView);
   }
   
   
    
}