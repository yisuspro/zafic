<?php
/**
*
*@autor jesus andres castellanos aguilar
* helper encargado  de la reglas de validacion de los formularios del aplicativo
*
*/
/**
*
*funcion encargada de las reglas de inicio de sesion.
*retorna el vector de errores
*@return array ()
*
*/
function getRulesLogin(){
    return array(
        array(
            'field' => 'email',
            'label' => 'Correo',
            'rules' => 'required',              //campo requerido y en formato de email
             'errors' => array(
                 'required' => 'el correo es requerido',    //mensajes de error
                 'valid_email' => 'correo mal escrito',
             ),
        ),
        array(
            'field' => 'password',
            'label' => 'contraseña',
            'rules' => 'required',                           //campo requerido
            'errors' => array(
                'required' => 'la contraseña es requerida.', //mensajes de error
            ),
        ),
    );
}
