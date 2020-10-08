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
class Cicle extends CI_Model {
    
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
    public function datosCicle($datos){
        if(!$rol= $this->db->select('*')->from('cicles')
           ->join('plans','cicles.CCLS_FK_plans = plans.PLAN_PK')
           ->where('CCLS_PK',$datos)){
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
        $rol= $this->db->select('*')
            ->from('cicles')
            ->join('plans','cicles.CCLS_FK_plans = plans.PLAN_PK');
           //->join('versions','plans.PLAN_PK = versions.VRSN_FK_plans')
        return $rol->get();
    }
    
    /**
    * funcion para la eliminacion de un plan de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminar($datos){
        if(!$this->db->delete('cicles', array('CCLS_PK' => $datos))){
            return FALSE;
        }
        return TRUE;
    }
    
    /**
    * funcion para la modificacion de datos de los planes en la base de datos 
    * @param int $datos |String $datos2
    * @return true | false
    */
    public function modificarCicle($datos,$datos2){
        $this->db->where('CCLS_PK', $datos);
        if($this->db->update('cicles', $datos2)){
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
    public function agregarCicle($datos){
        if(!$this->db->insert('cicles',$datos)){
            return false;
        }
        return true;
    }
    
    /**
    * funcion para listar las versiones que contiene los planes
    * @param int $id
    * @return true | false
    */
    public function listarVersionCicle($id){
        $version= $this->db->select('*')->from('versions')->join('versions','versions_plans.VRPL_FK_versions = versions.VRSN_PK')->where('VRPL_FK_plans',$id);
        return $version->get();
    }
    
    /**
    * funcion para la eliminacion de una version asignada a un plan de la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminarVersionCicle($datos){
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
    public function consultarVersioCicle($plan,$version){
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
    
    /**
    * funcion para la consulta de todos miembros de un un curso en la base de datos.
    * 
    * @return get() 
    */
    public function listarMiembros($cicle){
        $rol= $this->db->select('*')->from('users_members_cicles')->join('users','users_members_cicles.UMCL_FK_users = users.USER_PK')->join('roles','users_members_cicles.UMCL_FK_roles = roles.ROLE_PK')->where('UMCL_FK_cicles',$cicle);
        return $rol->get();
    }
    
    /**
    * funcion para agregar nuevos datos miembros en un curso en la base de datos
    * @param int $datos
    * @return true | false
    */
    public function agregarMiembroCicle($datos){
        if(!$this->db->insert('users_members_cicles',$datos)){
            return false;
        }
        return true;
    }
    
    /**
    * funcion para verificar si un miembro en un curso se encuentraen la base de datos
    * @param int $cicle, $user 
    * @return true | false
    */
    public function verificarMiembroCicle($cicle,$user){
        if($this->db->select('*')->from('users_members_cicles')->where('UMCL_FK_cicles',$cicle)->where('UMCL_FK_users',$user)->get()->result()){
            return true;
        }
        return false;
    }
    
    /**
    * funcion para eliminar los miembros de un curso en la bse de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminarrMiembroCicle($datos){
        if(!$this->db->delete('users_members_cicles', array('UMCL_PK' => $datos))){
            return false;
        }
        return true;
    }
    
    /**
    * funcion para la consulta de todas las marterias en un curso en la base de datos.
    * 
    * @return get() 
    */
    public function listarMateriaCicle($id){
        $rol= $this->db->select('*')->from('cicles_subjects')->join('subjects','cicles_subjects.CLSB_FK_subjects = subjects.SBJC_PK')->where('CLSB_FK_cicles',$id);
        return $rol->get();
    }
    
    /**
    * funcion para aeliminar materias  en un curso en la base de datos
    * @param int $datos
    * @return true | false
    */
    public function eliminarMateriaCicle($datos){
        if(!$this->db->delete('cicles_subjects', array('CLSB_PK' => $datos))){
            return false;
        }
        return true;
    }
    
    /**
    * funcion para listar todas las asignatras que se pueden agregra al curso.
    * 
    * @return get() 
    */
    public function listarMaterias(){
        $rol= $this->db->select('*')->from('subjects');
        return $rol->get();
    }
    
    /**
    * funcion consultar si la materia  se encuentra ya registrada enn el curso en la base de datos
    * @param int $curso, $materia
    * @return true | false
    */
    public function consultarMateriaCicle($curso,$materia){
        $where= "CLSB_FK_cicles ='".$curso."' AND CLSB_FK_subjects ='".$materia."'";
        if($this->db->from('cicles_subjects')->where($where)->get()->result()){
            return true;
        }
    }
    
    /**
    * funcion para asignar una materia a un curso en la base de datos
    * @param int $datos
    * @return true | false
    */
    public function asignarMateria($datos){
         if(!$this->db->insert('cicles_subjects',$datos)){
            return false;
        }
    }
    
    
    
}