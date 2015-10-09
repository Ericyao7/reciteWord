<?php
$lifeTime = 2 * 3600;
session_set_cookie_params($lifeTime);
session_start();

error_reporting(E_ALL ^ E_WARNING);
//include 'php/security.php';
include_once 'php/commons.php';

if(!$_SESSION['userID']){
	header("Location: ../reciteWord/php/login/Login.php");
}

$template = new FastTemplate("view/html/templates");

$template->define(array(
		"main" => "main.html",
));


$template->assign("USER_NAME", $_SESSION['username']);
$template->assign("USER_IMG",$_SESSION['userimg']);
$template->assign("USER_ID", $_SESSION['userID']);
//$template->assign("USER_TOKEN", $TOKEN);
$template->parse("CONTENT", "main");
$template->FastPrint();


?>