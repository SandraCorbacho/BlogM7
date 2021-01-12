<?php

namespace App\Controllers;
use App\Controller;
use App\View;
use App\ExPDO;
use App\Request;
use App\Session;
use App\DB;

final class CommentController extends Controller implements View,ExPDO{
    public function __construct(Request $request, Session $session){
        parent::__construct($request, $session);
    }
    public function create(){
        $title = filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
        $idPost = filter_input(INPUT_POST,'idPost',FILTER_SANITIZE_STRING);
        $comment = filter_input(INPUT_POST,'comment',FILTER_SANITIZE_STRING);
       
        $data = [
            'title' => $title,
            'user' => Session::get('user'),
            'idPost' =>  $idPost,
            'description'=> $comment,
            
        ];
        
        $db = $this->getDB();
        $db->createComment($data);
        
        header('Location:'.BASE.'post/detail/'.$idPost);
    }
    public function delete(){
        
        $db = $this->getDB();
        $subcategories = $db->selectWhereNot('Categories','CategoriaPadre','');
        $allCategories = $db->selectAll('Categories');
        $id = filter_input(INPUT_POST,'id',FILTER_SANITIZE_STRING);
        $db->delete('Comment', 'id',$id);

        header('Location:'.BASE.'perfil');
    }
}