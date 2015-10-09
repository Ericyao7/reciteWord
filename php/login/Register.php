<?php 
error_reporting(E_ALL ^ E_WARNING);
include '../commons.php';
include 'RegisterVerify.php';
$template = new FastTemplate("../../view/html/templates/register");

$template->define(array(
		"main" => "register.html",
		"ol" => "ol.html",
		"li" => "li.html",
		"success" => "success.html",
		"option" => "option.html"
));
$template->assign("USER_NAME", "");
$template->assign("EMAIL", "");

//$template->assign("BYEAR_SELECTED", "");

$template->assign("MESSAGE", "");
$template->parse("CONTENT", "main");


if (isset ( $_POST ['formsubmitted'] )) {
	verifyandinsert();
}


$template->parse("CONTENT", "main");
$template->FastPrint();
?>