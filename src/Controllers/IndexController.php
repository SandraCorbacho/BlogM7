<?php

namespace App\Controllers;
use App\Request;
use App\Session;
use App\Controller;

final class IndexController extends Controller{
    public function __construct(Request $request,Session $session){
        parent::__construct($request, $session);
    }
    public function index(){
        $db = $this->getDB();
        $posts = $db->selectAll('Post');
        $allCategories = $db->selectAll('Categories');
        $subcategories = $db->selectWhereNot('Categories','CategoriaPadre','');
        
        $dataView = [
            'title' => 'home',
            'Posts' => $posts,
            'categories' => $allCategories,
            'subcategorias' => $subcategories
        ];
        $this->render($dataView);
   
    }
    
}