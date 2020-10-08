<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
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
        $this->load->model('welcomeModel');
        $this->load->helper(['url','form','login_rules']);
        $this->twig->addGlobal('session', $this->session); 
    }
    
	public function index()
	{
		$this->twig->display('user/index');
	}	
    
    
    public function login()
	{
		$this->twig->display('login');
	}
    
    
     /**
    *funcion para la validacion de logueo de los usuarios.
    *utiliza el llamado del helper login_rules para la validacion de los datos por medio del metodo getRulesLogin()
    *si no es valido los campos o el inicio de sesion manda un mensaje de error respectivamente en caso contraro inicia la secion con los datos del usuario
    * @return var_dum () | json_encode() | set_status_helper()
    */
    
    public function validate(){
        $this->form_validation->set_error_delimiters('','');// quita los delimitadores del error
        $rules= getRulesLogin();                            //obtiene las reglas los campos de email y de password 
        $this->form_validation->set_rules($rules);          //valida los campos de email y de password deacuerdo a las reglas
        if($this->form_validation->run() === FALSE){        //si los campos son invalidos 
            $errors = array(
                'email'=> form_error('email'),              //solocita el error del campo email
                'password'=> form_error('password')         //solocita el error del campo pasword
            );
            echo json_encode($errors);                      //envio de los errores
            $this->output->set_status_header(401);          //envio del codigo del error en este caso error 401
        }else{                                              // si los campos se encuentran bien 
            $email= $this->input->post('email');            //optiene el valor del campo email
            $pass= $this->input->post('password');          //optiene el valor del campo password
            if(!$res = $this->welcomeModel->login($email,$pass)){ // si el usuario y contrseña no existen o conciden 
                echo json_encode(array('msg'=> 'Verifique sus credenciales' ));// envio de  mensaje de  error
                $this->output->set_status_header(402);      //envio del codigo de error
            }else{                                          //si el email existe y conside las contraseña
                
                $usuario_data = array(                      //creacion de vector con todos  los datos del usuarios
                    'id'            => $res->USER_PK,
                    'doc'           => $res->USER_identification,
                    'username'      => $res->USER_username,
                    'name'          => $res->USER_names,
                    'lastname'      => $res->USER_lastnames,
                    'email'         => $res->USER_email,
                    'password'      => $res->USER_password,
                    'address'       => $res->USER_address,
                    'telephone'     => $res->USER_telephone,
                    'state'         => $res->STTS_state,
                    'type_identification'=> $res->TPDI_type_identification,
                    'gender'        => $res->GNDR_gender,
                    'logueado'      => TRUE,                //hace verdadero el inicio de sesion del usuarios en el vector de datos
            );
            $this->session->set_userdata($usuario_data);    //realiza el inicio de sesion del usuario
            }
        }
 
    }
    
    
    /**
    *funcion para el rompimiento de sesion de los usuarios.
    *cierra la sesion y redirecina al usuario a el login
    *
    * @return redirect () 
    */
    public function logout(){
         $usuario_data = array(                      //creacion de vector con todos  los datos del usuarios
                    'logueado'      => FALSE,                //hace verdadero el inicio de sesion del usuarios en el vector de datos
            );
            $this->session->set_userdata($usuario_data);    //realiza el inicio de sesion del usuario
        $this->twig->display('user/index');
    }
    
}
