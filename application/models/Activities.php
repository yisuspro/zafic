<?php
/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a el inicio de sesion de usuarios
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class Activities extends CI_Model {
    
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
    * funcion para la verificacion y envio de los datos dell usuario logueado.
    *
    * @return row() | false
    */
    public function listar(){
        $actividades = $this->db->select('*')->from('activities');
        return $actividades->get();
    }
    /**
    * funcion para la verificacion y envio de los datos dell usuario logueado.
    *
    * @return row() | false
    */
    public function cambioEstado($id){
        $queri=$this->db->select('ATVT_state')->from('activities')->where('ATVT_PK',$id)->get()->result() ;
       //return $queri[0]->ATVT_state;
        if( $queri[0]->ATVT_state == "0"){
            $data= array(
                'ATVT_state' => "2"
            );
            $query=$this->db->where('ATVT_PK',$id);
            $query=$this->db->update( 'activities', $data );
            return true;
             
        }else {
            $data= array(
                'ATVT_state' => "0"
            );
            $query=$this->db->where('ATVT_PK',$id);
            $query=$this->db->update( 'activities', $data );
             return false;
           
        }
    }
     /**
    * funcion para el registro de usuario 
    * @param String $datos
    * @return true | false
    */
    public function registrar($datos){
        if(!$this->db->insert('activities',$datos)){
            return false;
        }
        return true;
    }
    /**
    * funcion para el registro de usuario 
    * @param String $datos
    * @return true | false
    */
    public function eliminar($id){
        if(!$this->db->delete('activities', array('ATVT_PK' => $id))){
            return false;
        }
        return true;
    }
    
}
