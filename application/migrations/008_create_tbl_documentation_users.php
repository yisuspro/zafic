<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla documentation_users en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_documentation_users extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla documentation_users
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                                                    //creacion del vector que contiene los campos de la tabla
            'DOCU_PK' => array(                                                             //columna DOCU_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'DOCU_name' => array(                                                           //columna DOCU_name tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => 45,
            ),
             'DOCU_dscription' => array(                                                    //columna DOCU_dscription tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => 45,
            ),
             'DOCU_location' => array(                                                      //columna DOCU_location tipo VARCHAR, tamaño 45
                'type' => 'VARCHAR',
                'constraint' => 45,
            ),
            'DOCU_FK_users' => array(                                                       //columna DOCU_FK_users tipo int, tamaño 10
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('DOCU_PK', TRUE);                                           //agregar atributo de llave primaria al campo DOCU_PK 
        $this->dbforge->create_table('documentation_users');                                //creacion de la tabla users con los atributos y columnas
        $this->dbforge->add_column('documentation_users',[
            'CONSTRAINT DOCU_FK_users FOREIGN KEY(DOCU_FK_users) REFERENCES users(USER_PK)',
        ]);                                                                                 //creacion de relacion a la tabla users
    }
    
    /**
    * funcion para eliminacion de la tabla documentation_users
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('documentation_users');                                  //eliminacion de la tabla documentation_users
    }
}
 

