<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla roles en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_roles extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla roles
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(            //creacion del vector que contiene los campos de la tabla
            'ROLE_PK' => array(                     //columna ROLE_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'ROLE_name' => array(                   //columna ROLE_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'ROLE_shortname' => array(              //columna ROLE_shortname tipo VARCHAR, tamaño 45,no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),
            'ROLE_description' => array(            //columna USER_description tipo text, tamaño 45,no vacio
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            
            'ROLE_date_create' => array(                    //columna ROLE_address tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'ROLE_date_update' => array(                  //columna ROLE_telephone tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'ROLE_PK_create' => array(                    //columna ROLE_address tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
            'ROLE_PK_update' => array(                  //columna ROLE_telephone tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
        ));
        $this->dbforge->add_key('ROLE_PK', TRUE);   //agregar atributo de llave primaria al campo ROLE_PK    
        $this->dbforge->create_table('roles');      //creacion de la tabla roles con los atributos y columnas  
    }
    
    /**
    * funcion para eliminacion de la tabla roles
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('roles');        //eliminacion de la tabla roles
    }
}