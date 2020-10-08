<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_schools extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla users
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                //creacion del vector que contiene los campos de la tabla
            'SCHO_PK' => array(                         //columna SCHO_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'SCHO_identification' => array(                         //columna SCHO_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'SCHO_name_long' => array(                   //columna SCHO_username tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'SCHO_name_short' => array(                   //columna SCHO_username tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'SCHO_initials' => array(                      //columna SCHO_names tipo VARCHAR, tamaño 45,no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),
            'SCHO_telephone' => array(                  //columna SCHO_lastnames tipo VARCHAR, tamaño 45,no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),'SCHO_facebook' => array(                  //columna SCHO_lastnames tipo VARCHAR, tamaño 45,no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),'SCHO_instagram' => array(                  //columna SCHO_lastnames tipo VARCHAR, tamaño 45,no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),'SCHO_youtube' => array(                  //columna SCHO_lastnames tipo VARCHAR, tamaño 45,no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),
            'SCHO_email' => array(                      //columna SCHO_email tipo VARCHAR, tamaño 45,no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),
            'SCHO_date_create' => array(                    //columna SCHO_address tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'SCHO_date_update' => array(                  //columna SCHO_telephone tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'SCHO_PK_create' => array(                    //columna SCHO_address tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
            'SCHO_PK_update' => array(                  //columna SCHO_telephone tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
            'SCHO_FK_state' => array(                   //columna SCHO_FK_state tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('SCHO_PK', TRUE);       //agregar atributo de llave primaria al campo SCHO_PK 
        $this->dbforge->create_table('schools');          //creacion de la tabla users con los atributos y columnas
        $this->dbforge->add_column('schools',[
            'CONSTRAINT SCHO_FK_state FOREIGN KEY(SCHO_FK_state) REFERENCES states_schools(STSC_PK)',
        ]);                                       //creacion de relacion a la tabla genders
    }
    
    /**
    * funcion para eliminacion de la tabla users
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('users');            //eliminacion de la tabla users
    }
}