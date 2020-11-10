<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {
    
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    
    /**
    * metodo cnstructor donde se cargan todos los helpers, librerias y modelos necesarios en el controlador
    *@library 
    *@model  users()|logueo()
    *@helper login_rules() |url() |form ()
    * 
    */
    function __construct() {
        parent::__construct ();
        $this->load->model('Activities');
        $this->twig->addGlobal('session', $this->session); 
    }
    public function actividad()
	{
       $this->twig->display('user/actividades');
	}
    
    public function listar(){
        $draw   = intval($this->input->get("draw"));             //trae las varibles draw, start, length para la creacion de la tabla
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $data =$this->Activities->listar();                       //utiliza el metodo listar() del modelo plan() para traer los datos de todos los planes 
        $output = array(                                    //creacion del vector de salida
            "draw" => $draw,                                //envio la variable de dibujo de la tabla                    
            "recordsTotal" =>$data->num_rows(),             //envia el numero de filas  para saber cuantos usuarios son en total
            "recordsFiltered" => $data->num_rows(),         //envio el numero de filas para el calculo de la paginacion de la tabla
            "data" => $data->result_array()                                 //envia todos los datos de la tabla
        );
        echo json_encode($output);                          //envio del vector de salida con los parametros correspondientes
        exit; 
	}
    
     public function publicar($id){
       /*if($this->Activities->cambioEstado($id)){
           echo json_encode (array('msg'=> 'Cambio de estado' ));
       }else{
           echo json_encode (array('msg'=> 'Error al cambiar de estado' ));
           $this->output->set_status_header(401); 
       }*/
        
         echo json_encode ($this->Activities->cambioEstado($id));
	}
    
    public function agregar(){
     
        $configFile =[
            "upload_path"   => "./assets/upload/".$this->input->post('ATVT_title'),
            "allowed_types" => "png|jpg",
            "file_name"     =>"imagen.png"
        ];
        
        if(!is_dir($configFile['upload_path'])) mkdir($configFile['upload_path'], 0777, TRUE);
        
        $this->load->library("upload",$configFile);
        if($this->upload->do_upload('ATVT_image')){
            $file=array (
                "upload_data" => $this->upload->data()
            );
                    
            $data= array(
                'ATVT_title' => $this->input->post('ATVT_title'),
                'ATVT_description' => $this->input->post('ATVT_description'),            
                'ATVT_link' => $this->input->post('ATVT_link'),           
                'ATVT_state' => 0,            
                'ATVT_invited' => $this->input->post('ATVT_invited'),            
                'ATVT_otros' => $this->input->post('ATVT_otros'),            
                'ATVT_date' => $this->input->post('ATVT_date'),            
                'ATVT_day' => $this->input->post('ATVT_day'),          
                'ATVT_image' => "assets/upload/".$this->input->post('ATVT_title')."/".$configFile['file_name'],
            ); 

            if($query=$this->Activities->registrar($data)){
                echo json_encode ('win');
            }else{
                echo json_encode ('error');
            }
            
        }else{
            echo json_encode($this->upload->display_errors());
        }
        
        
        
        
    }
    
    public function eliminar($id)
	{
        if($this->Activities->eliminar($id)){
           echo json_encode (array('msg'=> 'Cambio de estado' ));
       }else{
           echo json_encode (array('msg'=> 'Error al cambiar de estado' ));
           $this->output->set_status_header(401); 
       }
	}
    
   
    
	
}