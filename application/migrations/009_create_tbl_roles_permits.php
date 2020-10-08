<?php
/**
*
*@autor jesus andres castellanos aguilar
*
*archivo de migracion encargado de la cracion y eliminacion de la tabla roles_permits en la base de datos
* 
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tbl_roles_permits extends CI_Migration {
    
    /**
    * funcion para crreacion de la tabla users
    *
    * @return create_table()
    */
    public function up(){
        $this->dbforge->add_field(array(                                                                   //creacion del vector que contiene los campos de la tabla
            'RLPR_PK' => array(                                                                            //columna RLPR_PK tipo int, tamaño 10, auto icremental, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'RLPR_FK_roles' => array(                                                                       //columna RLPR_FK_roles tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
            'RLPR_FK_permits' => array(                                                                     //columna RLPR_FK_permits tipo int, tamaño 10, solo positivos
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
            ),
        ));
        $this->dbforge->add_key('RLPR_PK', TRUE);                                                           //agregar atributo de llave primaria al campo RLPR_PK
        $this->dbforge->create_table('roles_permits');                                                      //creacion de la tabla users con los atributos y columnas
        $this->dbforge->add_column('roles_permits',[
            'CONSTRAINT RLPR_FK_roles FOREIGN KEY(RLPR_FK_roles) REFERENCES roles(ROLE_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla roles
        $this->dbforge->add_column('roles_permits',[
            'CONSTRAINT RLPR_FK_permits FOREIGN KEY(RLPR_FK_permits) REFERENCES permits(PRMS_PK)',
        ]);                                                                                                 //creacion de relacion a la tabla permits
    }
    /**
    * funcion para eliminacion de la tabla roles_permits
    *
    * @return drop_table()
    */
    public function down(){
        $this->dbforge->drop_table('roles_permits');                                                         //eliminacion de la tabla users
    }
}
