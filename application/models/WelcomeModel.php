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
class welcomeModel extends CI_Model {
    
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
    public function login($email,$password){
        $rep=$this->db->select('*')
            ->join('states','users.USER_FK_state = states.STTS_PK')
            ->join('genders','users.USER_FK_gender = genders.GNDR_PK')
            ->join('types_identifications','users.USER_FK_type_identification = types_identifications.TPDI_PK')
            ->get_where('users',array('USER_email' => $email,'USER_password'=> $password), 1);
        if (!$rep->result()){
            return FALSE;
        }
        $consulta =$rep;
        return $consulta->row();
    }
    
    
    public function permisosUsuario($id,$permiso){
        $where="USRL_FK_roles = ROLE_PK AND PRMS_PK=RLPR_FK_permits AND RLPR_FK_roles=ROLE_PK AND USRL_FK_users=USER_PK";
        $this->db->select('PRMS_shortname')
            ->from('users,roles,permits,users_roles,roles_permits')->where($where);
        $this->db->where('USER_PK',$id);
        if($res=$this->db->where('PRMS_shortname',$permiso)->get()->result()){
            return true;
        }else{
           return false; 
        }
        
    }
    

    
    
}
