<?php
session_start();

function verifyLogin() {
	global $template;
	global $dbc;
	//global $ID;
	
	if(isset($_POST["uname"]) && isset($_POST["pwd"])){
		$correct = true;
		if(empty(trim($_POST["uname"]))){
			$template->assign("LI", "Please enter your user name");
			$template->parse("OL", "li");
			$correct = false;
		}
		if(empty($_POST["pwd"])){
			$template->assign("LI",  "Please enter your password");
			$template->parse("OL", ".li");
			$correct = false;
		}
		
		if(!$correct) {
			$template->assign("USER", trim($_POST["uname"]));
			$template->parse("ERROR_MESSAGE", "ol");
			$template->parse("CONTENT", "main");
		}
		
		$isFind_un = false;
		
		$isPwdcorrect = false;
		if($correct){
			$uname = addslashes(trim($_POST["uname"]));
			$pwd = addslashes(trim($_POST["pwd"]));
			$nameVeriSql = "select * from USERS where  User_name = '$uname'";
			
			/*
			 * NAME VERIFICATION
			*/
			if(!$res = mysqli_query($dbc,$nameVeriSql)){
				$template->assign("ERROR_MESSAGE", "DB error. Please check the DB configuration");
				$template->parse("CONTENT", "main");
				return ;
			}
			else{
				$row = mysqli_fetch_assoc($res);
				if(!empty($row)){
					$isFind_un = true;
					
					if(password_verify($pwd, addslashes(trim($row["User_pwd"])))){
						$isPwdcorrect = true;
						
						$UID = $row["User_id"];
						$USN = $row["User_name"];
						$UIMG = $row["image"];
						$param = "id=".$UID."&name=".$USN;
						$_SESSION['userID']=$UID;
						$_SESSION['username'] = $USN;
						$_SESSION['userimg'] = $UIMG;
						if(!$_SESSION['userimg']){
							$_SESSION['userimg'] = "avatar.jpg";
						}
						header("Location: ../../../reciteWord?");
						//header("name",$USN);
						
						//echo "successful!";
					}
					else{
						$isPwdcorrect = false;
					}
				}
				else {
					$isFind_un = false;
				}
			}
			
			
			if(!$isFind_un){
				$template->assign("ERROR_MESSAGE", "user name doesn't exist!");
				$template->parse("CONTENT", "main");
			}
			elseif(!$isPwdcorrect) {
				$template->assign("ERROR_MESSAGE", "Sorry,password is not correct");
				$template->parse("CONTENT", "main");
			}
		}
	}
}
?>