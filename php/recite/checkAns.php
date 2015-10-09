<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
include_once '../commons.php';
include 'checkResultOperation.php';

header('Cache-control: private, must-revalidate'); //support page back


$template = new FastTemplate("../../view/html/templates/reciteWord");

$template->define(array(
		"main" => "checkResult.html",
		"ol" => "ol.html",
		"li" => "li.html"
));
$template->assign("OL","");
$template->assign("ACCURANCY","");
$template->assign("USER_NAME", $_SESSION['username']);
$template->assign("USER_IMG",$_SESSION['userimg']);
$template->assign("USER_ID", $_SESSION['userID']);



if(isset($_POST["checkAns"])){
	$class = $_SESSION['class'];
	//echo "class  = ".$class;
	$userID = $_SESSION['userID'];
	$trueNo = showTrueIDs($userID,$class);
	//echo "<BR> trueNo = ".$trueNo;
	$template->clear("OL");
	$wrongNo = showWrongIDs($userID,$class);
	//echo "<BR> wrongNo = ".$wrongNo;
	$acc = intval($trueNo/($trueNo+$wrongNo)*100);
	$template->assign("ACCURANCY",$acc."%");
	saveAcc($userID,$acc);
	
}


$template->parse("CONTENT", "main");
$template->FastPrint();

?>