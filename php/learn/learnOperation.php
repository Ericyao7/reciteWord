<?php
function showNext($checkpoint,$class){
	global $template;
	global $dbc;
	$getNextWordSql = "SELECT word,words_id,word_def FROM words WHERE classification = '$class' and classSequID = '$checkpoint'+1";
	if(!$res = mysqli_query($dbc,$getNextWordSql)){
		$template->assign("DEFINITION", "DB error.");
		$template->parse("CONTENT", "main");
		return ;
	}
	else{
	
		while($row = mysqli_fetch_assoc($res)){
			
				$wordID = $row["words_id"];
				$template->assign("NEWWORD",$row["word"]);
				$template->assign("DEFINITION",$row["word_def"]);
			
		}
		
	}
	return $wordID;
}


function showCurrentWord($checkpoint,$class){
	global $template;
	global $dbc;
	//echo "checkpoint = ".$checkpoint;
	$getWordSql = "SELECT word,word_def FROM words WHERE classSequID = '$checkpoint' and classification = '$class'";
	if(!$res = mysqli_query($dbc,$getWordSql)){
		$template->assign("DEFINITION", "DB error please check your DB configuration.");
		$template->parse("CONTENT", "main");
		return ;
	}
	else{
	
		while($row = mysqli_fetch_assoc($res)){
			$template->assign("NEWWORD",$row["word"]);
			$template->assign("DEFINITION",$row["word_def"]);
		}
	}
}


function getLearnCheckPoint($userID,$class){
	global $template;
	global $dbc;
	$checkClass;
	if($class==1){
		$getCPSql = "SELECT checkone FROM users WHERE user_id = '$userID'";
		$checkClass = "checkone";
	}else if($class==2){
		$getCPSql = "SELECT checktwo FROM users WHERE user_id = '$userID'";
		$checkClass = "checktwo";
	}else if($class==3){
		$getCPSql = "SELECT checkthree FROM users WHERE user_id = '$userID'";
		$checkClass = "checkthree";
	}
	if(!$res = mysqli_query($dbc,$getCPSql)){
		$template->assign("DEFINITION", "DB error.");
		$template->parse("CONTENT", "main");
		return ;
	}
	else{
	
		while($row = mysqli_fetch_assoc($res)){
			$checkpoint = $row[$checkClass];
		}
	
	}
	return $checkpoint;
}


function saveLearnWord($userID,$wordID,$class){
	global $dbc;
	global $template;
	
	$checkEsixtSql = "SELECT * FROM userword WHERE user_id = '$userID' and word_id = '$wordID'";
	$checkRes = mysqli_query($dbc,$checkEsixtSql);
	
	
	
	$s=mysqli_num_rows($checkRes);
	if($s== 0){
		
		$saveWordSql = "INSERT INTO userword(`user_id`,`word_id`,`state`,`class`)"." VALUES ('$userID','$wordID','1','$class');";
			
		if(!$res = mysqli_query($dbc,$saveWordSql)){
			//$template->assign("NEWWORD","Congratulation!");
			$template->assign("DEFINITION", "save error");
			$template->parse("CONTENT", "main");
			return ;
		}
	}else{
			
		}
	
	
}

function updateCheckPoint($userID,$class,$checkpoint){
	global $template;
	global $dbc;
	$new = $checkpoint+1;
	//$checkClass;
	if($class==1){
		$updateCPSql = "UPDATE users SET `checkone` = '$new' WHERE user_id = '$userID'";
		//echo "here";
	}else if($class==2){
		$updateCPSql = "UPDATE users SET `checktwo` = '$new' WHERE user_id = '$userID'";
	}else if($class==3){
		$updateCPSql = "UPDATE users SET `checkthree` = '$new' WHERE user_id = '$userID'";
	}	
	
	if(!$res = mysqli_query($dbc,$updateCPSql)){
		$template->assign("DEFINITION", "update error.");
		$template->parse("CONTENT", "main");
		return ;
	}
	
}




function restartLearn($userID,$class){
	global $template;
	global $dbc;
	
	//$checkClass;
	if($class==1){
		$updateCPSql = "UPDATE users SET `checkone` = '1' WHERE user_id = '$userID'";
		//echo "here";
	}else if($class==2){
		$updateCPSql = "UPDATE users SET `checktwo` = '1' WHERE user_id = '$userID'";
	}else if($class==3){
		$updateCPSql = "UPDATE users SET `checkthree` = '1' WHERE user_id = '$userID'";
	}	
	
	if(!$res = mysqli_query($dbc,$updateCPSql)){
		$template->assign("DEFINITION", "restart error.");
		$template->parse("CONTENT", "main");
		return ;
	}
}

function deleteWords($userID,$class){
	global $template;
	global $dbc;
	
	
	
		$deleteSql = "DELETE FROM userword WHERE user_id = '$userID' and class = '$class'";
		mysqli_query($dbc,$deleteSql);
	
	
}
















?>