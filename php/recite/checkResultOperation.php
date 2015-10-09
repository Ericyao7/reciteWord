<?php
function showTrueIDs($userID,$class){
	global $template;
	global $dbc;
	
	$wordIDArr = array();
	$wordsArr = array();
	$defArr = array();
	$getTrueWordSql = "SELECT word_id FROM userword WHERE user_id = '$userID' and state = '2' and class = '$class'";
	if(!$res = mysqli_query($dbc,$getTrueWordSql)){
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
	$no = 0;
	$i = 1;
	$tmp="";
	foreach ($wordsArr as $e){
		if($i%2==0){
			$tmp = $tmp."  =============>   ".$e;
			
			$template->assign("LI",$tmp);
			$template->parse("OL",".li");
			$no++;
		}else{
			$tmp = $e;
		}
		$i++;
	}
	
	$template->parse("TRUEWORDS","ol");
	
	return $no;
	
}
	
	
	
	
function showWrongIDs($userID,$class){
	global $template;
	global $dbc;
	$template->clear("OL");
	$template->clear("LI");
	$wordIDArr = array();
	$wordsArr = array();
	$defArr = array();
	$getWrongWordSql = "SELECT word_id FROM userword WHERE user_id = '$userID' and state = '3' and class = '$class'";
	if(!$res = mysqli_query($dbc,$getWrongWordSql)){
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
				//$wordsArr = $row["word"];
				//$defArr =$row["word_def"];
				array_push($wordsArr,$row["word"]);
				array_push($wordsArr,$row["word_def"]);
			}
		}
	}
	$no=0;
	$i = 1;
	$tmp="";
	foreach ($wordsArr as $e){
		if($i%2==0){
			$tmp = $tmp."  =============>   ".$e;
				
			$template->assign("LI",$tmp);
			$template->parse("OL",".li");
			$no++;
		}else{
			$tmp = $e;
		}
		$i++;
	}
	
	$template->parse("WRONGWORDS","ol");

	return $no;
}

function saveAcc($userID,$acc){
	global $template;
	global $dbc;
	
	$saveAccSql = "UPDATE users SET `user_acc` = '$acc' WHERE user_id = '$userID'";
	if(!$res = mysqli_query($dbc,$saveAccSql)){
		$template->assign("DEFINITION", "saveAcc error.");
		$template->parse("CONTENT", "main");
		return ;
	}
}



?>