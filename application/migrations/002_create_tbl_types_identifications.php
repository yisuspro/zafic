<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla types_identifications en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_types_identifications extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla types_identifications
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                        //creacion del vector que contiene los campos de la tabla    
            'TPDI_PK' => array(                                 //columna TPDI_PK tipo int, tamaño 10, auto icremental, no vacio 
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'TPDI_type_identification' => array(                //columna TPDI_type_identification tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
        ));
        $this->dbforge->add_key('TPDI_PK', TRUE);               //agregar atributo de llave primaria al campo TPDI_PK 
        $this->dbforge->create_table('types_identifications');  //creacion de la tabla types_identifications con los atributos y columnas
    }
    
    /**
    *funcion para eliminacion de la tabla types_identifications
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('types_identifications');    //eliminacion de la tabla states
    }
}