<?php
/**
*@autor jesus andres castellanos aguilar
* controlador encargado de todos los procesos referente a la migracion de base de datos
*
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Migrate extends CI_Controller{
    
    /**
    * funcion para ejecutar la migracion de los usuarios.
    *
    * @return show_error() | migration()
    */
    public function index(){
        
        $this->load->library('migration');                  //carga la libreria de migracion
        if ($this->migration->current() === FALSE){         //si falla la migracion envia un mensaje de error
            show_error($this->migration->error_string());   //mensaje de error
        }
    }
}