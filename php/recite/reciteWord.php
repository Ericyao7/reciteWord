<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
include_once '../commons.php';
include 'reciteOperation.php';

header('Cache-control: private, must-revalidate'); //support page back


if(!$_SESSION['userID']){
	header("Location: ../../../reciteWord/php/login/Login.php");
}


$template = new FastTemplate("../../view/html/templates/reciteWord");
$template->define(array(
		"main" => "reciteWord.html",
		"ol" => "ol.html",
		"li" => "li.html"
));

$template->assign("MESSAGE","");
$template->assign("NEWWORD","");
$template->assign("DEFINITION","You have no words need to be recited");

if(isset($_POST["classification"])){
	$userID =$_SESSION['userID'];
	$class = $_POST["classification"];
	$_SESSION['class'] = $class;
	resetState($userID,$class);
	$wordID = selectRandomWord($userID,$class);
	$_SESSION['thisWord'] = $wordID;
	$_SESSION['class'] = $class;
	showCurrentDef($wordID);
	showCurrentWords($wordID,$class);
	
	
}


if(isset($_POST["chooseWord"])){
	//echo "get it!";
	$chooseWord = $_POST["chooseWord"];
	$correctWordID = $_SESSION['thisWord'];
	$userID =$_SESSION['userID'];
	$class = $_SESSION['class'];
	$correctWord = verifyCorrect($correctWordID);
	
	if($correctWord===$chooseWord){
		saveRight($userID,$correctWordID);
	}else{
		saveWrong($userID,$correctWordID);
	}
	
	echo "userID = ".$userID."class = ".$class;
	$wordID = selectRandomWord($userID,$class);
	
	if($wordID==null){
		$template->assign("NEWWORD","");
		$template->assign("DEFINITION","");
		$template->assign("WORD1","");
		$template->assign("WORD2","");
		$template->assign("WORD3","");
		$template->assign("WORD4","");
		$template->assign("MESSAGE","You have finished the recite process");
	}else{
	
	$_SESSION['thisWord'] = $wordID;
	echo "wordID = ".$wordID;
	showCurrentDef($wordID);
	showCurrentWords($wordID,$class);
	}
	
}




$template->parse("CONTENT", "main");
$template->FastPrint();

?>