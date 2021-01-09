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
        $dataView = [
            'title' => 'detail',
            'Post' => $post,
            'categories' => $allCategories,
            'subcategorias' => $subcategories,
            'comments'  => null
        ];
        $this->render($dataView, 'detailPost');
    }

}