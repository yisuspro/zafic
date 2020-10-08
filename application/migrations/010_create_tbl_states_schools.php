<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla states en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_states_schools extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla states
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(            //creacion del vector que contiene los campos de la tabla
            'STSC_PK' => array(                     //columna STSC_PK tipo int, tamaño 10, auto icremental, no vacio   
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'STSC_state' => array(                  //columna STSC_state tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
        ));
        $this->dbforge->add_key('STSC_PK', TRUE);   //agregar atributo de llave primaria al campo STSC_PK 
        $this->dbforge->create_table('states_schools');     //creacion de la tabla states con los atributos y columnas
    }
    
    /**
    * funcion para eliminacion de la tabla states
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('states_schools');       //eliminacion de la tabla states
    }
}