<?php 
error_reporting(E_ALL ^ E_WARNING);
include_once '../commons.php';
		
include 'LoginVerify.php';

if(isset($_POST["logout"])){
	unset($_SESSION['userID']);
}


$template = new FastTemplate("../../view/html/templates/login");

$template->define(array(
		"main" => "login.html",
		"ol" => "ol.html",
		"li" => "li.html"
));

$template->assign("ERROR_MESSAGE", "");
$template->assign("USER", "");
$template->parse("CONTENT", "main");


if(isset($_POST["hiddensubmit"])) {
	verifyLogin();
}


$template->FastPrint();

?>