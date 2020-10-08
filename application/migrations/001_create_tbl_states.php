<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla states en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_states extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla states
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(            //creacion del vector que contiene los campos de la tabla
            'STTS_PK' => array(                     //columna STTS_PK tipo int, tamaño 10, auto icremental, no vacio   
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'STTS_state' => array(                  //columna STTS_state tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
        ));
        $this->dbforge->add_key('STTS_PK', TRUE);   //agregar atributo de llave primaria al campo STTS_PK 
        $this->dbforge->create_table('states');     //creacion de la tabla states con los atributos y columnas
    }
    
    /**
    * funcion para eliminacion de la tabla states
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('states');       //eliminacion de la tabla states
    }
}