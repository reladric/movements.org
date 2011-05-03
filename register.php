<?php session_start();
	include_once('user.php');
	if(isset($_POST['reg_sub'])){
	$email=$_POST['reg_addr'];
	$pwd=$_POST['reg_pwd'];
	$rp=$_POST['reg_rpwd'];
	if(!(check_email_address($email))){
		echo "<body><h3 class='main'>Invalid Email Address</h3></body>";
	}
	else if(strlen($pwd)<4){
		echo "<body><h3 class='main'>Password should be atleast length 4</h3></body>";
	}
	else if(strlen($pwd)<4){
		echo "<body><h3 class='main'>Password should be atleast length 4</h3></body>";
	}
	else if($pwd!=$pwd){
		echo "<body><h3 class='main'>Password didn't match</h3></body>";
	}
	else{
		//If all is correct register nre user
		$r=register($email,$pwd,2);
		if($r){?>
			<body><h5 class='main'>Successful Registration. Please Login below.</h5>
			<?php
			
		}
		else{
			echo "<body><h3 class='main'>DB failure</h3></body>";
		}
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Registration</title>
    <link href="includes/css/reg.css" rel="stylesheet" type="text/css" />
	<script src="includes/js/jquery-1.5.js" type="text/javascript" charset="utf-8"></script>
   	<script src="includes/js/val.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div class="top">Content for  class "top" Goes Here</div>

	<div class="main">
		<h3 class="mainhead">Registration</h3>
		<h4 class="subhead">Enter registration details</h4>
		<form class="forms" action="register.php" method="post" name="regform" id="regform">
			<label for="Email">Email Address:</label><input name="reg_addr" id="reg_addr" type="text"/><span id="einf"></span><br/>
			<label for="pwd">Desired password:</label><input name="reg_pwd" id="reg_pwd" type="password"/><span id="pinf"></span><br/>
			<label for="rpwd">Repeat password:</label><input name="reg_rpwd" id="reg_rpwd" type="password"/><span id="rpinf"></span><br/>
			<input name="terms" id="terms" type="checkbox" value="on"/><label for="terms" class="check_radio">I agree to <a href="terms.php" class="lin">everything</a> you'll say </label><br/>
            <input name="reg_sub" id="reg_sub" type="submit" value="Register" />
        </form>
		</div>
</body>
</html>	