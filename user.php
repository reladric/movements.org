<?php
	session_start();
	/* Define Environment Constants */
	include_once('db_conn_admin.php');
	define('ROOT',"/m2/");
	define('SERV_ROOT',getenv("DOCUMENT_ROOT") . ROOT);
	
	/* You cannot access this file directly */
	if(basename($_SERVER['PHP_SELF'])=="user.php")
		header('Location:' . ROOT . 'login.php');

	/* Establish Database Connection */
	$mysql_conn = mysql_connect(DB_HOST,DB_UNAME,DB_PASSWORD) or die("Error Establishing Connection to Database");
	mysql_select_db(DB_NAME,$mysql_conn);

	/**
	 * generatePassword
	 * Generates a random String using A-Z,a-z,0-9,@,#,$,%
	 * @param $length Length of String to return
	 * @return A random string of length $length
	 */
	function generatePassword($length=5) 
	{
		$vowels = 'aeiouyACEUY'; $consonants = 'bdghjmnwpqrstvzBDGHJLMNWKPQRSTVWXZ23456789@#$%';
		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) 
		{
			if ($alt == 1) 
			{
				$password .= $consonants[(rand() % strlen($consonants))];
				$alt = 0;
			} 
			else 
			{
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
			}
		}
		return $password;
	}
	
	function sanitize($data) {
		global $mysql_conn;
		$data = trim($data);
		if(get_magic_quotes_gpc()) {
			$data = stripslashes($data);
		}
		$data = mysql_real_escape_string($data,$mysql_conn);
		return $data;
	}
	function check_email_address($email) {
  	// First, we check that there's one @ symbol, 
	// and that the lengths are right.
		if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
	    // Email invalid because wrong number of characters 
	    // in one section or wrong number of @ symbols.
    		return false;
		}
  		// Split it into sections
		$email_array = explode("@", $email);
		$local_array = explode(".", $email_array[0]);
		for ($i = 0; $i < sizeof($local_array); $i++) {
    		if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
	$local_array[$i])) {
		      return false;
    		}
		}
  		// Check if domain is IP. If not, 
		// it should be valid domain name
		if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
	    	$domain_array = explode(".", $email_array[1]);
	    	if (sizeof($domain_array) < 2) {
    	    	return false; // Not enough parts to domain
			}
		    for ($i = 0; $i < sizeof($domain_array); $i++) {
    			if(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$",$domain_array[$i])) {
	    		    return false;
	    		}	
			}
		}
  		return true;
	}
	function register($uname,$pwd,$authlevel = 100) {
		global $mysql_conn;
		$errorFlag = false;
		$errorArray;
		$uname = sanitize($uname);
		$hasheduname = sha1($uname);

		$pwd = sha1(md5($hasheduname) . sanitize($pwd));
		$result = mysql_query("SELECT name FROM " . AUTH_TABLE . " WHERE name = '$uname'",$mysql_conn) or die("Error Quering Database");
		if(mysql_num_rows($result) == 0) {
			mysql_query("INSERT INTO " . AUTH_TABLE . "(name,username,password,auth) VALUES('$uname','$hasheduname','$pwd','$authlevel')",$mysql_conn) or die("Error Quering Database");	
			$query=mysql_query("SELECT * FROM " . AUTH_TABLE . " WHERE name = '$uname'",$mysql_conn);
			$result1=mysql_fetch_assoc($query);
			mysql_query("INSERT INTO " . USER_TABLE . "(uid,points,firstname,lastname,dob,disp_dob,addr1,addr2,city,state,country,zip,phone,sec_email,nickname,twitter,fb,linkedin,iscomplete) VALUES( '".$result1['id']."','','','','','','','','','','','','','','','','','','')",$mysql_conn) or die(mysql_error());	
		}
		else {
			$errorFlag = true;
			$errorArray[] = array("Username Already Exists","1");	
		}
		
		if($errorFlag)
			return $errorArray;
		else
			return true;
	}
	
	//Returns true if it manages to login with given uname,pwd
	function login($uname,$pwd,$stayloggedin=false)
	{
		global $mysql_conn,$_SESSION,$_SERVER;
		$uname=sha1(sanitize($uname));
		// Salted Password
		$pwd=sha1(md5($uname) . sanitize($pwd));
	
		/* Query database for given username & password */
		$Auth_Result = mysql_query("SELECT * FROM " . AUTH_TABLE . " WHERE username='$uname' AND password='$pwd' LIMIT 1",$mysql_conn) or die("Error Quering Database");
		if(mysql_num_rows($Auth_Result)!=0)	{
			// Generate Random Session ID
			$session = generatePassword(32);
			$cookie = "";
			
			// Store Server's IP Address
			$ip=$_SERVER['REMOTE_ADDR'];
			
			if(!$stayloggedin)
				$que = "UPDATE " . AUTH_TABLE . " SET session='$session',ip='$ip' WHERE username='$uname'";
			else
			{
				$cookie = generatePassword(32);
				$que="UPDATE " . AUTH_TABLE . " SET session='$session',ip='$ip',cookie='$cookie' WHERE username='$uname'";
			}
			if(mysql_query($que,$mysql_conn))
			{
				$_SESSION['session']=$session;
				$_SESSION['uname']=$uname;
				if($cookie!="")
				{
					setcookie("cookie", $cookie, time()+604800,'/');
					setcookie("uname", $uname , time()+604800,'/');
				}
				return true;
			}
			else
				die("Error quering db");
		}
		unset($_SESSION['session'],$_SESSION['uname']);
		return false;
	}
	
	function logout ()
	{
		global $mysql_conn,$_SESSION,$_SERVER;
		if(isSet($_SESSION['session']) || isSet($_SESSION['uname']))
		{
			unset($_SESSION['session'],$_SESSION['uname']);
			setcookie("cookie","",time()-3600,'/');
			setcookie("uname","",time()-3600,'/');
		}
	}
	
	///returns true if logged in
	function isLogged() 
	{
		global $mysql_conn,$_SESSION,$_SERVER,$authlevel,$whoami,$uid;
		if(isSet($_SESSION['uname']) && isSet($_SESSION['session']))
		{
			$uname=$_SESSION['uname'];
			$session=$_SESSION['session'];
			$ip=$_SERVER['REMOTE_ADDR'];
			$res=mysql_query("SELECT * FROM " . AUTH_TABLE . " WHERE username='$uname' AND session='$session' AND ip='$ip'",$mysql_conn) or die("Error Quering Database");
			if(mysql_num_rows($res) != 0)
			{
				$res=mysql_fetch_array($res);
				$authlevel=$res['auth'];
				$whoami=$res['name'];
				$uid=$res['id'];
				return true;
			}
		}
		else if(isSet($_COOKIE['cookie']))
		{
			$cookie=$_COOKIE['cookie'];
			$uname=$_COOKIE['uname'];
			$res=mysql_query("SELECT * FROM " . AUTH_TABLE . " WHERE username='$uname' & cookie='&cookie'",$mysql_conn);
			if(mysql_num_rows($res) != 0)
			{
				$session=generatePassword(32);
				$ip=$_SERVER['REMOTE_ADDR'];
				if(mysql_query("UPDATE " . AUTH_TABLE . " SET session='$session',ip='$ip' WHERE username='$uname'",$mysql_conn))
				{
					$_SESSION['session']=$session;
					$_SESSION['uname']=$uname;
					$res=mysql_fetch_array($res);
					$authlevel=$res['auth'];
					$whoami=$res['name'];
					$uid=$res['id'];
					return true;
				}
				else die("Error Quering Database");				
			}
		}			
		unset($_SESSION['session'],$_SESSION['uname']);
		return false;
	}
	$logged_in=isLogged();
	function checkprof($uid){
		global $prof_complt;
		$checkprofilequery="select iscomplete from user where uid=$uid";
		$checkprofile=mysql_query($checkprofilequery);
		if($checkprofile)
		$profres=mysql_fetch_assoc($checkprofile);
		if($profres)
		if(mysql_num_rows($checkprofile)==0)
			$prof_complt=0;
		$prof_complt=$profres['iscomplete'];
	}
		checkprof($uid);
		if($logged_in && basename($_SERVER['PHP_SELF'])=="register.php")
		header('Location:' . ROOT . 'user/prof.php');
	if(!$logged_in && basename($_SERVER['PHP_SELF'])!="login.php" && basename($_SERVER['PHP_SELF'])!="register.php")
		header('Location:' . ROOT . 'login.php');
	else
		include_once(SERV_ROOT . "includes/files/functions.php");
			
?>
