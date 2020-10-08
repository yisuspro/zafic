<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla genders en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_genders extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla genders
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(            //creacion del vector que contiene los campos de la tabla    
            'GNDR_PK' => array(                     //columna GNDR_PK tipo int, tamaño 10, auto icremental, no vacio
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'GNDR_gender' => array(                 //columna GNDR_gender tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
        ));
        $this->dbforge->add_key('GNDR_PK', TRUE);   //agregar atributo de llave primaria al campo GNDR_PK 
        $this->dbforge->create_table('genders');    //creacion de la tabla genders con los atributos y columnas
    }
    
    /**
    *funcion para eliminacion de la tabla genders
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('genders');      //eliminacion de la tabla genders
    }
}