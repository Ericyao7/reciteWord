<?php
function verifyandinsert() {
	global $template;
	global $dbc;
	
	$error = array (); // Declare An Array to store the error message
	
	/*
	 * Validation of the user input
	 */
	
	//User Name
	if (!isset($_POST ['uname']) || empty ( $_POST ['uname'] )) { 
		$error [] = 'Please Enter a user name '; 
	}elseif(strlen($_POST['uname']) > 35){ 
		$error [] = 'Your User Name exceed the length';
	}else {
		$name = addslashes(trim(strip_tags($_POST ['uname'])));
		$template->assign("USER_NAME", $_POST ['uname']);
	}
	
	//Email
	if (!isset($_POST ['e-mail']) || empty( $_POST ['e-mail'] )) {
		$error [] = 'Please Enter your Email ';
	}
	elseif(strlen($_POST['e-mail']) > 35){
		$error [] = 'Your e-mail exceed the length';
	}else {
		$template->assign("EMAIL", $_POST ['e-mail']);
		if (preg_match ( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST ['e-mail'] )) {
				// regular expression for email validation
				$email = addslashes(trim(strip_tags($_POST ['e-mail'])));
		} else {
			$error [] = 'Your EMail Address is invalid  ';
		}
	}
	
	if (!isset($_POST ['pwd']) && empty ( $_POST ['pwd'] )) {
		$error [] = 'Please Enter Your Password ';
	}
	elseif(strlen($_POST['pwd']) > 30){
		$error [] = 'Sorry, Your password is too long ';
	} else {
		$Password = addslashes(trim($_POST ['pwd']));
	}
	if (!isset($_POST ['cpwd']) || empty ( $_POST ['cpwd'] )) {
		$error [] = 'Please Confirm Your Password';
	} elseif ($_POST ['cpwd'] != $_POST ['pwd']) {
		$error [] = "Sorry ,Two passwords are not equal";
	}
	
	
	$profileImg = "default.jpg";
	if(isset($_FILES['profileIcon']) && is_array($_FILES['profileIcon'])) {
		$fileName = $_FILES["profileIcon"]["name"];
		$fileTmpLoc =  $_FILES["profileIcon"]["tmp_name"];
		$fileErrorMsg = $_FILES["profileIcon"]["error"];
		$segmentOfName = explode(".", $fileName);
		$fileExt = end($segmentOfName);
		$extensionArr = array("jpeg", "jpg", "png", "gif");
		if ($fileErrorMsg === 0) {
			if(in_array(strtolower($fileExt), $extensionArr)) {
				$profileImg = rand(100000000000,999999999999).".".$fileExt;
				$moveResult = move_uploaded_file($fileTmpLoc, "../img/$profileImg");
				if($moveResult === false) {
					$error [] = "Sorry, please try another picture or confirm your picture has the permission for use";
				}
			} else {
				$error [] = "Unknown Profile Image Extension! ".$fileExt;
			}
		}
	}
	
		
/*------------------------------------------------------------------------------------------------------*/	
	
	if (empty ( $error )) // send to Database if there's no error '
	{
		$query_verify_name = "SELECT * FROM  USERS WHERE User_name ='$name'";
		
		$result_verify_name = mysqli_query ( $dbc, $query_verify_name );
		//echo $result_verify_name;
		
		$query_verify_email = "SELECT * FROM USERS  WHERE User_email ='$email'";
		$result_verify_email = mysqli_query ( $dbc, $query_verify_email );
		
		
		if (! $result_verify_email) { 
			$template->assign(" Database Error Occured ", 'Query Failed email ') ;
			echo "error333";
		}
		
		if (mysqli_num_rows($result_verify_email) == 0  && mysqli_num_rows($result_verify_name) == 0) { // IF no previous user is using this email .
		    $hashPwd = addslashes(trim(sprintf(password_hash($Password, PASSWORD_DEFAULT))));
			//echo $hashPwd;
			$fileImg = addslashes(trim($profileImg));
			$query_insert_user = "INSERT INTO USERS ( `User_name`, `User_email`, `User_pwd`,`image`,`checkone`,`checktwo`,`checkthree`)".
			"VALUES ('$name','$email', '$hashPwd','$fileImg','1','1','1');";
			
			if($dbc)
			{
				$result_insert_user = mysqli_query($dbc,$query_insert_user);	
				
			}
			else
			{
				echo "connection error";
			}
			
			
			
				
			//$result_insert_user = mysqli_query ( $dbc, sprintf($query_insert_user, $name, $email, password_hash($Password, PASSWORD_DEFAULT)));
			
			if (! $result_insert_user) {
				$template->assign("MESSAGE", 'Query Failed here ') ;
				$template->parse("CONTENT", "main");
			}
			
			if (mysqli_affected_rows ( $dbc ) == 1) { // If the Insert Query was successfull.
				$template->assign("SUCC_MESSAGE", "Thank you for registering! A confirmation email has been sent to " . $email);
				$template->parse("CONTENT", "success");
				$template->FastPrint();
				exit();
			} else { // If it did not run OK.
				$template->assign("OPPS! There something wrong happen,please try again later", 'Query Failed ') ;
				$template->parse("CONTENT", "main");
			}
		} else { // The name or email address is not available.
			$error_message = "";
			$email_error_message = "";
			$name_error_message = "";
			
			if(mysqli_num_rows($result_verify_email) > 0) {
				$template->assign("MESSAGE", 'Sorry! E-mail address has already been registered.') ;
				
			}
			
			if(mysqli_num_rows($result_verify_name) > 0) {
				$template->assign("MESSAGE", 'Sorry! username has already been registered.') ;
			}
			
			
			
			
			//$template->assign("MESSAGE", 'Sorry! '.$email_error_message." ".$_name_error_message.' has already been registered.') ;
			$template->parse("CONTENT", "main");
		}
	} else { // Display the error message
		
		foreach ( $error as $key => $values ) {
			$template->assign("LI", $values);
			$template->parse("OL", ".li");
		}
		$template->parse("MESSAGE", "ol");
		$template->parse("CONTENT", "main");
	}

}