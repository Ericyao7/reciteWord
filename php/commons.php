<?php

include_once dirname(__FILE__).'/lib/databaseClassMySQLi.php';

include_once dirname(__FILE__).'/constances.php';

// Fast Template
include_once dirname(__FILE__).'/lib/class.FastTemplate.php';

// Utils method
include_once  dirname(__FILE__).'/utils/SqlHelper.php' ;



//Picture methos
if(!file_exists(dirname(__FILE__)."/img")) {
	mkdir(dirname(__FILE__)."/img", 0777, true);
}

?>