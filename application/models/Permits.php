<?php

/**
*
*@autor jesus andres castellanos aguilar
*
* modelor encargado de todos los procesos referente a los permisos
* 
* contiene todas las consultas sql a la base de datos
* 
*/
class Permits extends CI_Model {
    
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
    * funcion para la verificacion y envio de los datos del permiso solicitado.
    * @param int $datos
    * @return get() | false
    */
    public function datosPermiso($datos){
        if(!$permiso= $this->db->select('*')->from('permits')->where('PRMS_PK',$datos)){
            return false;
        }else{
            return $permiso->get();
        }
    }
    
    /**
    * funcion para la consulta de todos los permisos a la base de datos.
    * 
    * @return get() 
    */
    public function listar(){
        $permiso= $this->db->select('*')->from('permits');
        return $permiso->get();
    }
    
    /**
    * funcion para la eliminacion de un permiso de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminar($datos){
        if(!$this->db->delete('permits', array('PRMS_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    
    /**
    * funcion para la eliminacion de un permiso asignado a un rol de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminarPermisoRol($rol,$permiso){
        $where='RLPR_FK_roles ='.$rol.' AND RLPR_FK_permits='.$permiso;
        if(!$this->db->delete('roles_permits',$where)){
            return FALSE;
        }
        return true;
    }
    
    /**
    * funcion para la modificacion de datos de los permisos en la base de datos 
    * @param int $datos
    * @return true | false
    */
    public function modificarPermisos($datos,$datos2){
        $this->db->where('PRMS_PK', $datos);
        if($this->db->update('permits', $datos2)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
    * funcion para agregar nuevos datos de permisos en la base de datos
    * @param int $datos
    * @return true | false
    */
    public function agregarPermiso($datos){
         if(!$this->db->insert('permits',$datos)){
            return false;
        }
        return true;
    }
    
    /**
    * funcion para consultar si un permisos esta asigando en la base de datos
    * @param int $id, $pertmiso
    * @return true | false
    */
    public function consultarPermisoRol($rol,$permiso){
        $where= "RLPR_fk_roles ='".$rol."' AND RLPR_FK_permits ='".$permiso."'";
         if($this->db->from('roles_permits')->where($where)->get()->result()){
            return true;
        }
    }
    
    /**
    * funcion para asignar un permiso a un rol en la base de datos
    * @param int $datos
    * @return true | false
    */
    public function asignarPermiso($datos){
         if(!$this->db->insert('roles_permits',$datos)){
            return false;
        }
    }
}