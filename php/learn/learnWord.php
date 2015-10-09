<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
include_once '../commons.php';
include 'learnOperation.php';

header('Cache-control: private, must-revalidate'); //support page back


if(!$_SESSION['userID']){
	header("Location: ../../../reciteWord/php/login/Login.php");
}


$template = new FastTemplate("../../view/html/templates/learnWord");

$template->define(array(
		"main" => "learnWord.html",
		"ol" => "ol.html",
		"li" => "li.html",
		"restart" => "restart.html"
));

$template->assign("MESSAGE","");
$template->assign("NEWWORD","");
$template->assign("DEFINITION","");
$checkpoint;




if(isset($_POST["classification"])){
	$userID = $_SESSION['userID'];
	$class = $_POST["classification"];
	$_SESSION['class'] =$_POST["classification"];
	//$class = 2;
	$checkpoint = getLearnCheckPoint($userID,$class);
	showCurrentWord($checkpoint,$class);
	
}

if(isset($_POST["learnNext"])){
	$userID = $_SESSION['userID'];
	$class = $_SESSION['class'];
	
	$checkpoint = getLearnCheckPoint($userID,$class);
	$wordID = showNext($checkpoint,$class);
	if($wordID==null){
		$template->assign("NEWWORD","");
		$template->assign("DEFINITION","");
		$template->assign("MESSAGE","Congratulation,you have learn all the words!");
	}else{
		saveLearnWord($userID,$wordID,$class);
		updateCheckPoint($userID,$class,$checkpoint);
	}
	
}


if(isset($_POST["restart"])){
	$userID = $_SESSION['userID'];
	$class = $_SESSION['class'];
	restartLearn($userID,$class);
	$checkpoint = getLearnCheckPoint($userID,$class);
	showCurrentWord($checkpoint,$class);
}

if(isset($_POST["cleanAndRestart"])){
	$userID = $_SESSION['userID'];
	$class = $_SESSION['class'];
	deleteWords($userID,$class);
	restartLearn($userID,$class);
	$checkpoint = getLearnCheckPoint($userID,$class);
	showCurrentWord($checkpoint,$class);
	
}

//$template->assign("DEFINITION","haha");
$template->parse("CONTENT", "main");
$template->FastPrint();

?>
