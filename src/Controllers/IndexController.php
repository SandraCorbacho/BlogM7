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
        $allCategories = $db->selectAll('Categories');
        $posts = $db->selectAll('Post');
        $subcategories = $db->selectWhere('Categories','CategoriaPadre','');
        
        $dataView = [
            'title' => 'home',
            'Posts' => $posts,
            'categories' => $allCategories,
            'subcategorias' => $subcategories
        ];
        $this->render($dataView);
   
    }
    
}