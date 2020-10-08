<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a los usuarios
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class Users extends CI_Model {
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
    * funcion para la verificacion y envio de los datos del usuario solicitado.
    * @param int $doc
    * @return row() | false
    */
    public function verificarUsuario($doc){
        $this->db->where('USER_PK',$doc);
        $query=$this->db->get('users');
        
        if( $query->num_rows()==1) return $query->row();
        else   return false;
    }
    
    /**
    * funcion para la verificacion y envio de los datos del usuario solicitado.
    * @param int $doc
    * @return row() | false
    */
    public function verificarUsuarioDoc($doc){
        if (!$rep=$this->db->select('USER_PK')->from('users')->where('USER_identification',$doc)->get()){
            return FALSE;
        }
        return $rep;
    }
    
    /**
    * funcion para el registro de usuario 
    * @param String $datos
    * @return true | false
    */
    public function registrar($datos){
        if(!$this->db->insert('users',$datos)){
            return false;
        }
        return true;
    }
    
    /**
    * funcion para traer todos los usuarios registrados 
    * 
    * @return get()
    */
    public function listar(){
        $usuarios = $this->db->select('*')->from('users')->join('states','users.USER_FK_state = states.STTS_PK')->join('genders','users.USER_FK_gender = genders.GNDR_PK')->join('types_identifications','users.USER_FK_type_identification = types_identifications.TPDI_PK');
        return $usuarios->get();
    }
    
    

    /**
    * funcion para la eliminacion de un usuario 
    * @param int $datos
    * @return true | false
    */
    public function eliminar($datos){
        if(!$this->db->delete('users', array('USER_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    
    /**
    * funcion para traer datos especificos de un usuario 
    * @param int $datos
    * @return get() | false
    */
    public function datosUsuario($datos){
        if(!$usuario= $this->db->select('*')->from('users')->where('USER_PK',$datos)->join('states','users.USER_FK_state = states.STTS_PK')->join('genders','users.USER_FK_gender = genders.GNDR_PK')->join('types_identifications','users.USER_FK_type_identification = types_identifications.TPDI_PK')){
            return false;
        }else{
            return $usuario->get();
        }
    }
    
    /**
    * funcion para la modificacion de datis de un usuario 
    * @param int $datos | String $datos2
    * @return true | false
    */
    public function modificarUsuario($datos,$datos2){
        $this->db->where('USER_PK', $datos);
        if($this->db->update('users', $datos2)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
    * funcion para el agregar estado
    * @param String $datos
    * @return true | false
    */
    public function agregarEstado($datos){
        if(!$this->db->insert('states',$datos)){
            return false;
        }
        return true;
    }
    /**
    * funcion para el registro de usuario 
    * @param String $datos
    * @return true | false
    */
    public function registrarT($datos){
        if(!$this->db->insert('types_identifications',$datos)){
            return false;
        }
        return true;
    }
    /**
    * funcion para el registro de usuario 
    * @param String $datos
    * @return true | false
    */
    public function registrarG($datos){
        if(!$this->db->insert('genders',$datos)){
            return false;
        }
        return true;
    }

}