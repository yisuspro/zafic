<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla users_roles en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_create_tbl_users_roles extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla users_roles
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                                                        //creacion del vector que contiene los campos de la tabla
            'USRL_PK' => array(                                                                 //columna USRL_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'USRL_FK_users' => array(                                                           //columna USRL_FK_users tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'USRL_FK_roles' => array(                                                           //columna USRL_FK_roles tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('USRL_PK', TRUE);                                               //agregar atributo de llave primaria al campo USRL_PK 
        $this->dbforge->create_table('users_roles');                                            //creacion de la tabla users_roles con los atributos y columnas
        $this->dbforge->add_column('users_roles',[
            'CONSTRAINT USRL_FK_users FOREIGN KEY(USRL_FK_users) REFERENCES users(USER_PK)',
        ]);                                                                                     //creacion de relacion a la tabla users
        $this->dbforge->add_column('users_roles',[
            'CONSTRAINT USRL_FK_roles FOREIGN KEY(USRL_FK_roles) REFERENCES roles(ROLE_PK)',
        ]);                                                                                     //creacion de relacion a la tabla roles
    }
    
    
    /**
    * funcion para eliminacion de la tabla users_roles
    *
    * @return drop_table()
    */
    public function down()
    {
        $this->dbforge->drop_table('users_roles');                                               //eliminacion de la tabla users_roles
    }
}