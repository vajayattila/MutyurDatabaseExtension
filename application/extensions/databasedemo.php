<?php

if (! defined ( 'mutyurphpmvc_inited' ))
	exit ( 'No direct script access allowed' );
	
/**
 *  @file databasedemo.php
 *  @brief Database demo extension for MutyurPHPMVC. Project home: https://github.com/vajayattila/MutyurDatabaseExtension
 *	@author Vajay Attila (vajay.attila@gmail.com)
 *  @copyright MIT License (MIT)
 *  @date 2019.02.18
 *  @version 1.0.0.0
 */

require_once ('database.php');
require_once ('securitytool.php');
require_once ('databasedemo/opendatabase.php');
require_once ('databasedemo/version_methods.php');
require_once ('databasedemo/status.php');

class databasedemo extends sqlitedb{
    use opendatabase, version_methods;
    protected $dbname;
    protected $sectool; 
	protected $languagehandler;       

	function __construct(){
        parent::__construct();
		// Dependency
		databasedemo::setup_dependencies(
			databasedemo::get_class_name(), databasedemo::get_version(), 'extension',
			array(
                'sqlitedb'=>'1.0.0.0',
                'sectool'=>'1.0.0.1',
                'languagehandler'=>'1.0.0.1'
            )
        );
        $this->dbname=$this->get_config_value('database', 'database_name');
        $this->sectool=new securitytool();
        $this->languagehandler=new languagehandler();
        // for dependencies
        $this->registerobject($this, $this->sectool);
		$this->registerobject($this, $this->languagehandler);        
        $this->opendatabase();
    }
    
    public function get_class_name(){
        return 'databasedemo';
    }

    public function get_version(){
        return '1.0.0.0';
    }

    public function get_dbname(){
        return $this->dbname;
    }

    protected function setStatus(&$arr, $statuscode){
        $arr['statuscode']=$statuscode;
        if($statuscode==STATUS_SQL_ERROR){
            $arr['status']=$this->get_item(STATUS[$statuscode]).': '.$this->getlasterrormessage();  
        }else{
            $arr['status']=$this->get_item(STATUS[$statuscode]);
        }        
    }    

	function get_item($key){
		return $this->languagehandler->get_item($key);
	}    

}

// Eof databasedemo.php