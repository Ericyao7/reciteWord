<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
include_once '../commons.php';
header('Cache-control: private, must-revalidate'); //support page back


if(!$_SESSION['userID']){
	header("Location: ../../../reciteWord/php/login/Login.php");
}


global $dbc;
$template = new FastTemplate("../../view/html/templates/profile");

$template->define(array(
		"main" => "profile.html",
		"ol" => "ol.html",
		"li" => "li.html",
		"cell"=>"cells.html"
));

$template->assign("USER_NAME", $_SESSION['username']);
$template->assign("USER_IMG",$_SESSION['userimg']);
$template->assign("USER_ID", $_SESSION['userID']);
$template->assign("OL","");


$userID = $_SESSION['userID'];
$wordIDArr = array();
$wordsArr = array();
$defArr = array();
$getProfileWordSql = "SELECT word_id FROM userword WHERE user_id = '$userID'";
if(!$res = mysqli_query($dbc,$getProfileWordSql)){
	$template->assign("DEFINITION", "getProfileWordSql error.");
	$template->parse("CONTENT", "main");
	return ;
}else{
	while($row = mysqli_fetch_assoc($res)){
		array_push($wordIDArr, $row["word_id"]);
	}
}

foreach ($wordIDArr as $id){
	$getContentSql = "SELECT word, word_def FROM words WHERE words_id = '$id'";
	if(!$res = mysqli_query($dbc,$getContentSql)){
		$template->assign("DEFINITION", "getContentSql error.");
		$template->parse("CONTENT", "main");
		return ;
	}else{
		while($row = mysqli_fetch_assoc($res)){
			array_push($wordsArr,$row["word"]);
			array_push($wordsArr,$row["word_def"]);
		}
	}
}

$i = 1;
$tmp="";
foreach ($wordsArr as $e){
	if($i%2==0){
		$tmp = $tmp."=============>".$e;
		
		$template->assign("LI",$tmp);
		$template->parse("OL",".li");
	}else{
		$tmp = $e;
	}
	$i++;
}
$template->parse("BODY","ol");


//getAcc
$getAccSql = "SELECT user_acc FROM users WHERE user_id ='$userID'";
if(!$res = mysqli_query($dbc,$getAccSql)){
	$template->assign("DEFINITION", "getContentSql error.");
	$template->parse("CONTENT", "main");
	return ;
}else{
	while($row = mysqli_fetch_assoc($res)){
		$template->assign("ACCURANCY",$row["user_acc"]."%");
	}
}

//$template->parse("DEFBODY","ol");
$template->parse("CONTENT", "main");
$template->FastPrint();

?>