<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a los enfoques 
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class Focu extends CI_Model {
    
    /**
    * metodo constructor donde se cargan todos los helpers, librerias necesarios en el modelo
    *@library 
    *
    *@helper 
    * 
    */
    public function __construct(){
        
    }
    
     /**
    * funcion para la verificacion y envio de los datos del enfoque pedagogico solicitado.
    * @param int $datos
    * @return get() | false
    */
    public function datosFocus($datos){
        if(!$rol= $this->db->select('*')->from('focus')->where('FOCS_PK',$datos)){
            return false;
        }else{
            return $rol->get();
        }
    }
    /**
    * funcion para la consulta de todos los enfoques pedagogicos a la base de datos.
    * 
    * @return get() 
    */
    public function listar(){
        $rol= $this->db->select('*')->from('focus');
        return $rol->get();
    }
    
    /**
    * funcion para la eliminacion de un enfoque pedagogico de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminar($datos){
        if(!$this->db->delete('focus', array('FOCS_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    
    /**
    * funcion para la modificacion de datos de los enfoque pedagogicos en la base de datos 
    * @param int $datos |String $datos2
    * @return true | false
    */
    public function modificarFocus($datos,$datos2){
        $this->db->where('FOCS_PK', $datos);
        if($this->db->update('focus', $datos2)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
    * funcion para agregar nuevos datos de enfoque pedagogicos en la base de datos
    * @param int $datos
    * @return true | false
    */
    public function agregarFocus($datos){
        if(!$this->db->insert('focus',$datos)){
            return false;
        }
        return true;
    }
    
    
}