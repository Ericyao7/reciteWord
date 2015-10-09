<?php

//------------------------------- Data Base ----------------------
$mysqldi;
$dbc;
/*
 * Start DB
 */
function db() {
	global $mysqldi;
	global $dbc;
	
	if(empty($mysqldi)) {
		$mysqldi = new database();
		$mysqldi->setup(DATABASE_USER, DATABASE_PASSWORD, DATABASE_HOST, DATABASE_NAME);
		$dbc = $mysqldi->mysqli;
		
	}else{echo "fail to connect DB";}
}

db();





?>