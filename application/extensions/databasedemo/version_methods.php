<?php

if (! defined ( 'mutyurphpmvc_inited' ))
	exit ( 'No direct script access allowed' );
	
/**
 *  @file version_methods.php
 *  @brief Database methods for version table. Project home: https://github.com/vajayattila/MutyurDatabaseExtension
 *	@author Vajay Attila (vajay.attila@gmail.com)
 *  @copyright MIT License (MIT)
 *  @date 2019.02.18
 *  @version 1.0.0.0
 */

trait version_methods{

    function insertversion($uuid, $name, $version, $modulname, $partname){
        $timestamp = date('Y-m-d H:i:s');
        $db=$db=&$this;               
        $ret=$db->exec("insert into version (
            uuid, name, version, tstamp, modulname, partname
        ) values (
            '$uuid', '$name', '$version', '$timestamp', '$modulname', '$partname'
        )");
        return $ret;
    }

    function getversion($id){
        $statuscode=STATUS_OK;
        $result=$this->query(
            "SELECT * FROM version WHERE id=$id"
        );
        if($result!==false) {
            if(0<count($result)) {
                $return['version'] = $result;  
            } else {
                $statuscode=STATUS_VERSION_NOTFOUND;
            }
        }else{
            $statuscode=STATUS_SQL_ERROR; 
        }        
        $this->setStatus($return, $statuscode);
        return $return;
    }
}