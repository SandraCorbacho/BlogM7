<?php

namespace App;

class DB extends \PDO{
    static $instance;
    protected  $config;

    static function singleton(){
        if(!(self::$instance instanceof self)){
            self::$instance=new self();
        }
        return self::$instance;
    }

    public function __construct(){
        parent::__construct(DSN,USR,PWD);
    }
    function registerUser($data){
        $sql = "INSERT INTO Users (name,idrole,email,password) values ('{$data['name']}',  {$data['role']},'{$data['email']}','{$data['pass']}');";
        $stmt =self::$instance->prepare($sql);
    
        $stmt->execute();
        
        return 1;
    }
    private function loadConf(){
        $file = "config.json";
        $jsonString = file_get_contents($file);
        $arrayJson = json_decode($jsonString);
        return $arrayJson;
    }
    public function env(){
        $ipAddress = gethostbyname($_SERVER['SERVER_NAME']);

        if($ipAddress == '127.0.0.1'){
            return 'dev';
        }else{
            return 'pro';
        }
    
    }
    function selectAll($table, array $fields=null):array{
        
        if(is_array($fields)){
            $columns = implode(',', $fields);
        }else{
            $columns = '*';
        }
        $sql = "SELECT {$columns} FROM $table";
       
        $stmt = self::$instance->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      
        return $rows; 
    }
    function selectWhereNot($table,$condition,$dato,array $fields=null):array{

        if(is_array($fields)){
            $columns = implode(',', $fields);
        }else{
            $columns = '*';
        }
        $sql = "SELECT {$columns} FROM $table Where {$condition} != '$dato'";
    
        $stmt = self::$instance->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows; 
    }
    function selectWhere($table,$condition,$dato,$order=null,array $fields=null):array{

        if(is_array($fields)){
            $columns = implode(',', $fields);
        }else{
            $columns = '*';
        }
        if($order != null){
            $sql = "SELECT {$columns} FROM $table Where {$condition} = '$dato' order by $order";
        }else{
            $sql = "SELECT {$columns} FROM $table Where {$condition} = '$dato'";
        }
        
        
        $stmt = self::$instance->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows; 
    }
    function selectPost($table,$condition,$dato,array $fields=null):array{

        
        $sql = "SELECT Post.id,Post.Title,Post.Short_description,Post.description,Post.created,Post.idCategorie,Users.name,Users.idrole,Users.email,Users.password FROM $table INNER JOIN Users on $table.created= Users.id Where $table.{$condition} = $dato LIMIT 1";
        $stmt = self::$instance->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $rows; 
    }

    function selectUser($mail,$password){
       
        try{   
            $sql = 'SELECT * FROM Users WHERE email="'. $mail.'" LIMIT 1';
           
            $stmt = self::$instance->prepare($sql);
            $stmt->execute();
        
            $count=$stmt->rowCount();
           
            $row=$stmt->fetchAll(\PDO::FETCH_ASSOC);  
            
            if($count==1){
                
            
                
                $res=password_verify($password,$row[0]['password']);
               
                if ($res){
                                    
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }catch(PDOException $e){
            return false;
        }
    }
    
    //definimos las funciones
    public function createUser(array $data){
       
        if(!$this->existUser($data['email'])){
            
            $stmt = self::$instance->prepare("INSERT INTO users (email,name,subname,password,role) values ('{$data['email']}','{$data['name']}', '{$data['surname']}', '{$data['pass']}', {$data['role']});");
            $stmt->execute();
            return true;
        }
        return false;
    }
    public function existUser($email, &$data=null){
       
        try{   
             
            $stmt=self::$instance->prepare('SELECT * FROM Users WHERE email=:email LIMIT 1');
            $stmt->execute([':email'=>$email]);
          
            $count=$stmt->rowCount();
            
            $row=$stmt->fetchAll(\PDO::FETCH_ASSOC);
            
           
            if($count==1){ 
                $data = $row;
                
                return true;   
            }else{
                return false;
            }
        }catch(PDOException $e){
            return false;
        }
    }
    
    function delete($table,$condition,$id){
        
        try{
         $sql = "DELETE FROM $table WHERE $condition = $id;";
         $stmt = self::$instance->prepare($sql);
         $stmt->execute();
         }catch(PDOException $e){
           
                 return false;
         }
       
         return true;
     }
   
    function update($data){
       
        try{
        $sql = "UPDATE Post SET Title = '{$data['title']}',Short_description = '{$data['short_description']}',description = '{$data['description']}',idCategorie = {$data['categoria']} where id= {$data['id']}";
           
            $stmt = self::$instance->prepare($sql);
            $stmt->execute();
           
        }catch(\PDOException $e){
           
            return $e;
        }
        
       
        return true;
       
    }
    function editSubTask($data){
     
        try{
            $sql = "UPDATE task_items SET itemName = '{$data['itemName']}' where id={$data['id']};";
            
            $stmt = self::$instance->prepare($sql);
            $stmt->execute();
           
        }catch(\PDOException $e){
           
            return $e;
        }
        
      
        return true;
       
    }
    public function insertTask($data){
        $user=[];
        
        if($this->existUser($data['email'],$user)){
            
            
            $sql = "INSERT INTO tasks (description,user,start_date,finish_date) values ('{$data['description']}',{$user[0]['id']},'{$data['start_date']}','{$data['finish_date']}');";
        
            $stmt = self::$instance->prepare($sql);
            $stmt->execute();
        
            $stmt=self::$instance->prepare("SELECT MAX(id) AS id FROM tasks;");
            $stmt->execute();
            $row=$stmt->fetchAll(\PDO::FETCH_ASSOC);  
           
            $stmt = self::$instance->prepare("INSERT INTO task_items (taskeId,completed,itemName) values ({$row[0]['id']},0,'{$data['itemName']}');");
            $stmt->execute();
            return true;
        }
        return false;
    }
    
    
    public function createComment(array $data){
        $sql = "SELECT id FROM Users where email = '{$data['user']}'";
       
        $stmt = self::$instance->prepare($sql);
        $stmt->execute();
        $id = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $sql = "INSERT into Comment (title,description,created,created_at,update_at,idPost) values ('{$data['title']}','{$data['description']}','{$id[0]['id']}',NOW(),NOW(),{$data['idPost']});";
        
        $stmt = self::$instance->prepare($sql);
        $stmt->execute();
        return true;
    }
    public function createPost(array $data){
        
        $sql = "INSERT into Post (Title,Short_description,description,created,idCategorie) values ('{$data['title']}','{$data['short_description']}','{$data['description']}',{$data['create']},{$data['categoria']})";
        $stmt = self::$instance->prepare($sql);
        $stmt->execute();
        return true;
    }
}