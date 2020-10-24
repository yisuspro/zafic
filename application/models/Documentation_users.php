<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a los planes
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class Documentation_users extends CI_Model {
    
    /**
    * metodo constructor donde se cargan todos los helpers, librerias necesarios en el modelo
    *@library 
    *
    *@helper 
    * 
    */
    public function __construct(){
        
    }
    
    
    public function agregardocumentacion($datos){
        if(!$this->db->insert('documentation_users',$datos)){
            return false;
        }
        return true;
    }
    
    /**
    * funcion para traer todos los usuarios registrados 
    * 
    * @return get()
    */
    public function listar($data){
        $usuarios =  $this->db->select('DOCU_location')->from('documentation_users')->where('DOCU_FK_users',$data);
        return $usuarios->get();
    }
    
    
    
    
}