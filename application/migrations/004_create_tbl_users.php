<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_users extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla users
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                //creacion del vector que contiene los campos de la tabla
            'USER_PK' => array(                         //columna USER_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'USER_identification' => array(                         //columna USER_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'USER_username' => array(                   //columna USER_username tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'USER_names' => array(                      //columna USER_names tipo VARCHAR, tamaño 45,no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),
            'USER_lastnames' => array(                  //columna USER_lastnames tipo VARCHAR, tamaño 45,no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),
            'USER_password' => array(                   //columna USER_password tipo VARCHAR, tamaño 45,no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),
            'USER_email' => array(                      //columna USER_email tipo VARCHAR, tamaño 45,no vacio
                'type' => 'VARCHAR',
                'constraint' => '45',
                'null' => TRUE,
            ),
            'USER_address' => array(                    //columna USER_address tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'USER_telephone' => array(                  //columna USER_telephone tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'USER_date_create' => array(                    //columna USER_address tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'USER_date_update' => array(                  //columna USER_telephone tipo VARCHAR, tamaño 45
                'type' => 'DATETIME',
            ),
            'USER_PK_create' => array(                    //columna USER_address tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
            'USER_PK_update' => array(                  //columna USER_telephone tipo VARCHAR, tamaño 45
                'type' => 'INT',
            ),
            'USER_FK_type_identification' => array(     //columna USER_FK_type_identification tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'USER_FK_state' => array(                   //columna USER_FK_state tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'USER_FK_gender' => array(                  //columna USER_FK_gender tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('USER_PK', TRUE);       //agregar atributo de llave primaria al campo USER_PK 
        $this->dbforge->create_table('users');          //creacion de la tabla users con los atributos y columnas
        $this->dbforge->add_column('users',[
            'CONSTRAINT USER_FK_state FOREIGN KEY(USER_FK_state) REFERENCES states(STTS_PK)',
        ]);                                             //creacion de relacion a la tabla states
        $this->dbforge->add_column('users',[
            'CONSTRAINT USER_FK_type_identification FOREIGN KEY(USER_FK_type_identification) REFERENCES types_identifications(TPDI_PK)',
        ]);                                             //creacion de relacion a la tabla types_identifications
        $this->dbforge->add_column('users',[
            'CONSTRAINT USER_FK_gender FOREIGN KEY(USER_FK_gender) REFERENCES genders(GNDR_PK)',
        ]);                                             //creacion de relacion a la tabla genders
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