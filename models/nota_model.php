<?php
Class Nota_Model extends Models{
    public function __construct(){
        parent::__construct();
    }
    
    public function notaList(){
        
        return $this->db->select("SELECT * FROM tbl_user", array());
    } 
    public function notaUnicaLista($cedula){
        
        return $this->db->select("SELECT * FROM tbl_user WHERE cedula = :cedula", array(':cedula'=>$cedula));
         
    } 
    public function create($data){
        
        $this->db->insert('tbl_user', array(
           
           'cedula'    =>$data['cedula'], 
           'ape1'      =>$data['ape1'], 
           'ape2'      =>$data['ape2'], 
           'nombre'    =>$data['nombre'], 
           'sexo'      =>$data['sexo'], 
           'username'  =>$data['username'], 
           'password'  =>Hash::create('md5',$data['password'], HASH_PASSWORD_KEY), 
           'role'      =>$data['role'], 
           'email'     =>$data['email']
                
        )); 
        /*
        $sth = $this->db->prepare("INSERT INTO tbl_user 
            (`cedula`,`nombre`,`ape1`,`ape2`,`username`,`role`,`email`,`sexo`,`password`)
            VALUES(:cedula, :nombre, :ape1, :ape2, :usuario, :role,  :email, :sexo,:clave)");
        $sth->execute(array(
           ':cedula'    =>$data['cedula'], 
           ':ape1'      =>$data['ape1'], 
           ':ape2'      =>$data['ape2'], 
           ':nombre'    =>$data['nombre'], 
           ':sexo'      =>$data['sexo'], 
           ':usuario'   =>$data['usuario'], 
           ':clave'     =>Hash::create('md5',$data['clave'], HASH_PASSWORD_KEY), 
           ':role'      =>$data['role'], 
           ':email'     =>$data['email'] 
        ));
        return $sth->fetchAll();
        */
    }
    public function editSave($data){
        
        $posData = array(
        'cedula'    =>$data['cedula'], 
        'ape1'      =>$data['ape1'], 
        'ape2'      =>$data['ape2'], 
        'nombre'    =>$data['nombre'], 
        'sexo'      =>$data['sexo'], 
        'username'  =>$data['username'], 
        'password'  =>Hash::create('md5',$data['password'], HASH_PASSWORD_KEY), 
        'role'      =>$data['role'], 
        'email'     =>$data['email']);
        
        $this->db->update('tbl_user', $posData, "`cedula` = {$data['cedula']}");     
    }
    public function delete($cedula){
        
        $result = $this->db->select("SELECT role FROM tbl_user WHERE cedula = :cedula", array(':cedula' => $cedula));
        
        if($result[0]['role'] == 'ADMIN'){
            return false;
        }
        
        $this->db->delete('tbl_user', "cedula = '$cedula'");
        $sth = $this->db->prepare("DELETE FROM tbl_user WHERE cedula = :cedula");
        $sth->execute(array(':cedula'=>$cedula));
        
  
    }
}

?>