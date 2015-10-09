<?php

function selectRandomWord($userID,$class){
	global $dbc;
	global $template;
	$getRandomWordID = "SELECT word_id FROM userword WHERE user_id = '$userID' and class = '$class' and state = '1' order By Rand() Limit 1";
	if(!$res = mysqli_query($dbc,$getRandomWordID)){
		$template->assign("DEFINITION", "randonId error.");
		$template->parse("CONTENT", "main");
		return ;
	}else{
		while($row = mysqli_fetch_assoc($res)){
			$wordID = $row["word_id"];
		}
	}
	//echo "wordID = ".$wordID;
	return $wordID;
}


function showCurrentDef($wordID){
	global $dbc;
	global $template;
	
	$getDefSql = "SELECT word_def FROM words WHERE words_id = '$wordID'";
	if(!$res = mysqli_query($dbc,$getDefSql)){
		$template->assign("DEFINITION", "randonId error.");
		$template->parse("CONTENT", "main");
		return ;
	}else{
		while($row = mysqli_fetch_assoc($res)){
			$template->assign("DEFINITION",$row["word_def"]);
			$template->parse("CONTENT","main");
		}
	}
}


function showCurrentWords($wordID,$class){
	global $dbc;
	global $template;
	$words = array();
	$getCurWordSql = "SELECT word FROM words WHERE words_id = '$wordID'";
	if(!$res = mysqli_query($dbc,$getCurWordSql)){
		$template->assign("DEFINITION", "DB error. Please check your DB");
		$template->parse("CONTENT", "main");
		return ;
	}else{
		while($row = mysqli_fetch_assoc($res)){
			array_push($words, $row["word"]);
			//echo "Coword = ".$row["word"]."<BR>";
		}
	}
	
	$getRandomWordsSql = "SELECT word FROM words WHERE classification = '$class' and words_id <> '$wordID' order By Rand() Limit 3";
	if(!$res = mysqli_query($dbc,$getRandomWordsSql)){
		$template->assign("DEFINITION", "GetRandomWords error.");
		$template->parse("CONTENT", "main");
		return ;
	}else{
		while($row = mysqli_fetch_assoc($res)){
			
			array_push($words, $row["word"]);
			//echo "Ranword = ".$row["word"]."<BR>";
			
		}
	}
	
	shuffle($words);//disorder the words
	
	$template->assign("WORD1",$words[0]);
	$template->assign("WORD2",$words[1]);
	$template->assign("WORD3",$words[2]);
	$template->assign("WORD4",$words[3]);
	$template->parse("CONTENT","main");
} 


function verifyCorrect($wordID){
	global $dbc;
	global $template;
	$getCurWordSql = "SELECT word FROM words WHERE words_id = '$wordID' ";
	if(!$res = mysqli_query($dbc,$getCurWordSql)){
		$template->assign("DEFINITION", "VerifyCorrect error.");
		$template->parse("CONTENT", "main");
		return "sm gui";
	}else{
		while($row = mysqli_fetch_assoc($res)){
			return $row['word'];
		}
	
	}
	return $row[0];
}

function saveWrong($userID,$wordID){
	global $dbc;
	global $template;
	$saveWrongSql = "UPDATE userword SET `state` = '3' WHERE user_id = '$userID' and word_id = '$wordID'";
	if(!$res = mysqli_query($dbc,$saveWrongSql)){
		$template->assign("DEFINITION", "saveWrong error.");
		$template->parse("CONTENT", "main");
		return;
	}
}




function saveRight($userID,$wordID){
	global $dbc;
	global $template;
	$saveRightSql = "UPDATE userword SET `state` = '2' WHERE user_id = '$userID' and word_id = '$wordID'";
	if(!$res = mysqli_query($dbc,$saveRightSql)){
		$template->assign("DEFINITION", "saveRight error.");
		$template->parse("CONTENT", "main");
		return;
	}
}

function resetState($userID,$class){
	global $dbc;
	global $template;
	$resetStateSql = "UPDATE userword SET `state` = '1' WHERE user_id = '$userID' and class = '$class'";
	if(!$res = mysqli_query($dbc,$resetStateSql)){
		$template->assign("DEFINITION", "resetState error.");
		$template->parse("CONTENT", "main");
		return;
	}
}


?>