<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a los roles
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class Role extends CI_Model {
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
    * funcion para la verificacion y envio de los datos del rol solicitado.
    * @param int $datos
    * @return get() | false
    */
    public function datosRol($datos){
        if(!$rol= $this->db->select('*')
           ->from('roles')
           ->where('ROLE_PK',$datos)){
            return false;
        }else{
            return $rol->get();
        }
    }
    /**
    * funcion para la consulta de todos los roles a la base de datos.
    * 
    * @return get() 
    */
    public function listar(){
        $rol= $this->db->select('*')->from('roles');
        return $rol->get();
    }
    
    /**
    * funcion para la consulta de todos los roles a la base de datos.
    * 
    * @return get() 
    */
    
    public function eliminar($datos){
        if(!$this->db->delete('roles', array('ROLE_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    
    /**
    * funcion para la modificacion de datos de los roles en la base de datos 
    * @param int $datos
    * @return true | false
    */
    public function modificarRol($datos,$datos2){
        $this->db->where('ROLE_PK', $datos);
        if($this->db->update('roles', $datos2)){
            return true;
        }else{
            return false;
        }
    }
    /**
    * funcion para agregar nuevos datos de roles en la base de datos
    * @param int $datos
    * @return true | false
    */
    public function agregarRol($datos){
         if(!$this->db->insert('roles',$datos)){
            return false;
        }
        return true;
    }
    
    /**
    * funcion consultar si el rol ya se encuentra asignado a un usuario
    * @param int $user, $rol
    * @return true | false
    */
    public function consultarRolUsuario($user,$rol){
        $where= "USRL_FK_users ='".$user."' AND USRL_FK_roles ='".$rol."'";
        if($this->db->from('users_roles')->where($where)->get()->result()){
            return true;
        }
    }
    
    /**
    * funcion para asignar un rol a un usuario en la base de datos
    * @param int $datos
    * @return true | false
    */
    public function asignarRol($datos){
         if(!$this->db->insert('users_roles',$datos)){
            return false;
        }
    }
    
    /**
    * funcion para la eliminacion de un rol asignado a un usuario de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminarRolUsuario($usuario,$role){
        $where='USRL_FK_users ='.$usuario.' AND USRL_FK_roles='.$role;
        if(!$this->db->delete('users_roles', $where)){
            return FALSE;
        }
        return true;
    }
}