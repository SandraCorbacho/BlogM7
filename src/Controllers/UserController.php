<?php

namespace App\Controllers;
use App\Controller;
use App\View;
use App\ExPDO;
use App\Request;
use App\Session;
use App\DB;

class UserController extends Controller implements View,ExPDO{
    
    public function __construct(Request $request, Session $session){
        parent::__construct($request, $session);
    }

    public function index(){
        $db = $this->getDB();
        $subcategories = $db->selectWhereNot('Categories','CategoriaPadre','');
        $allCategories = $db->selectAll('Categories');
        $dataView = [
            'title' => 'login',
            'categories' => $allCategories,
            'subcategorias' => $subcategories,
           
        ];
        $this->render($dataView, 'login');
      
    }
    public function register(){
        Session::set('loginMessage','');
        $db = $this->getDB();
        $subcategories = $db->selectWhereNot('Categories','CategoriaPadre','');
        $allCategories = $db->selectAll('Categories');
        $dataView = [
            'title' => 'register',
            'categories' => $allCategories,
            'subcategorias' => $subcategories,
        
        ];
        $this->render($dataView, 'register');
           
      
        if(filter_input(INPUT_POST,'pass2')!= null){
           
            //die(filter_input(INPUT_POST,'pass2'));
            $data = [
                'email'     => filter_input(INPUT_POST, 'correo'),
                'name'      => filter_input(INPUT_POST, 'name'),
                'pass'      => password_hash(filter_input(INPUT_POST, 'pass'),PASSWORD_BCRYPT,['cost'=>4]),
                'role'      => 2
            ];
            $exist = $db->existUser(filter_input(INPUT_POST, 'correo'));
          
            if($exist){
               
               Session::set('loginMessage','Usuario ya existente en nuestra base de datos');
               
                
                
            }else{
                
                $register = $db->registerUser($data);
               
                if($register){
                    Session::set('user',filter_input(INPUT_POST, 'correo'));
                    Session::set('loginMessage','Usuario registrado con éxito');
                    $user = $db->selectWhere('Users','email',filter_input(INPUT_POST, 'correo'));
                    Session::set('user',filter_input(INPUT_POST, 'correo'));
                    Session::set('userRole',$user[0]['idrole']);
                    
                }
                
            
            }
           

        }
    }

    public function login(){
        $db = $this->getDB();
        $exist = $db->existUser(filter_input(INPUT_POST, 'correo'));
        if($exist){
            //sino comprobaremos si existe en la base de datos
            $email = filter_input(INPUT_POST, 'correo',FILTER_SANITIZE_EMAIL);
            $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
            if(DB::selectUser($email,$pass)){
                Session::delete('loginMessage');
                $user = $db->selectWhere('Users','email',filter_input(INPUT_POST, 'correo'));
               
                Session::set('user',$email);
                Session::set('userRole',$user[0]['idrole']);
                header('Location:'.BASE);
            }else{
                Session::set('loginMessage','Contraseña o Usuario incorrecto');
                
                header('Location:'.BASE.'user');
            }
        }
    }
}