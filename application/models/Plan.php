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
class Plan extends CI_Model {
    
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
    * funcion para la verificacion y envio de los datos del plan solicitado.
    * @param int $datos
    * @return get() | false
    */
    public function datosPlan($datos){
        if(!$rol= $this->db->select('*')->from('plans')->where('PLAN_PK',$datos)){
            return false;
        }else{
            return $rol->get();
        }
    }
    
    /**
    * funcion para la consulta de todos los planes a la base de datos.
    * 
    * @return get() 
    */
    public function listar(){
        $rol= $this->db->select('*')->from('plans');
        return $rol->get();
    }
    
    /**
    * funcion para la eliminacion de un plan de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminar($datos){
        if(!$this->db->delete('plans', array('PLAN_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    
    /**
    * funcion para la modificacion de datos de los planes en la base de datos 
    * @param int $datos |String $datos2
    * @return true | false
    */
    public function modificarPlan($datos,$datos2){
        $this->db->where('PLAN_PK', $datos);
        if($this->db->update('plans', $datos2)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
    * funcion para agregar nuevos datos de planes en la base de datos
    * @param int $datos
    * @return true | false
    */
    public function agregarPlan($datos){
        if(!$this->db->insert('plans',$datos)){
            return false;
        }
        return true;
    }
    
    /**
    * funcion para listartodas las versiones y los planes
    * 
    * @return true | false
    */
    public function listarVersionsPlans(){
        $version= $this->db->select('*')->from('plans');
        return $version->get();
    }
    /**
    * funcion para listar las versiones que contiene los planes
    * @param int $id
    * @return true | false
    */
    public function listarVersionPlan($id){
        $version= $this->db->select('*')->from('plans')
            ->join('versions','plans.PLAN_PK = versions.VRSN_FK_plans');
        return $version->get();
    }
    
    /**
    * funcion para la eliminacion de una version asignada a un plan de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminarVersionPlan($datos){
        if(!$this->db->delete('versions_plans', array('VRPL_PK' => $datos))){
            return FALSE;
        }
        return true;
    }
    
    /**
    * funcion para la consulta de una version de un plan en la bse de datos
    * @param int $datos
    * @return true | false
    */
    public function consultarVersioPlan($plan,$version){
        $where= "VRPL_FK_versions ='".$version."' AND VRPL_FK_plans ='".$plan."'";
         if($this->db->from('versions_plans')->where($where)->get()->result()){
            return true;
        }
    }
    
    /**
    * funcion para la asignacion de  versiones a un plan existente
    * @param int $datos
    * @return true | false
    */
    public function asignarVersion($datos){
         if(!$this->db->insert('versions_plans',$datos)){
            return false;
        }
    }
}