<?php

if (! defined ( 'mutyurphpmvc_inited' ))
	exit ( 'No direct script access allowed' );
	
/**
 *  @file opendatabase.php
 *  @brief Create and open database. Project home: https://github.com/vajayattila/MutyurDatabaseExtension
 *	@author Vajay Attila (vajay.attila@gmail.com)
 *  @copyright MIT License (MIT)
 *  @date 2019.02.18
 *  @version 1.0.0.0
 */

trait opendatabase{

    function opendatabase(){
        $dbname=$this->dbname;

        if(!$this->databaseisexist($dbname)){ // database is not exist
            $this->open($dbname);        
            $this->createdbstructure();
            $this->initdbdata();
        }else{
            $this->open($dbname);                    
        }
    }

    public function createdbstructure(){
        $ret=$this->createtableifnotexists('version', // version table
            $this->set(
                ', ',
                $this->field('id', 'INTEGER', $this->set(' ', 
                    $this->primary('PK_VERSION', 'ASC', '' , 'AUTOINCREMENT'), $this->notnull(), $this->unique())
                ),
                $this->field('uuid', 'TEXT', $this->set(' ',  $this->notnull(), $this->unique())),
                $this->field('name', 'TEXT', $this->set(' ', $this->notnull(), $this->unique(), $this->collate('NOCASE'))),
                $this->field('modulname', 'TEXT', $this->set($this->notnull(), $this->collate('NOCASE'))),                
                $this->field('partname', 'TEXT', $this->set($this->notnull(), $this->collate('NOCASE'))),                                
                $this->field('version', 'TEXT', $this->notnull()),
                $this->field('tstamp', 'TIMESTAMP', $this->notnull())
            )
        );
        if($ret!==true){
            die($this->getlasterrormessage());
        }
    }

    public function initdbdata(){
        $st=&$this->sectool;
        $db=&$this->db; 
        // versions
        $ret=$this->insertversion( // defined in dbmethods trait
            $st->getuuid(), $this->get_class_name(), $this->get_version(), 'DatabaseDemo', 'Sqlite Demo Database'
        );        
        if($ret!==true){
            die($this->getlasterrormessage());
        }        
    }
}
