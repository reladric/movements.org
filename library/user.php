<?php
/**
 * This file contains code required for authentication of user, registerng new user and logging in of existing user
 * @author SVCE Team
 * @version 1.0
 * @package includes
 */
	/**
	* PHP file containing DB connectivity code
	*/
	include_once('db_conn_admin.php');
	$root="G/";
	$currpath="/" . $root."user/";
	mysql_select_db("movements",$mysql_conn);
	/**
	*function to strip the data of any javascript code to prevent sqlinjection
	* @param string $data data to be 'cleaned up'
	* @return string
	*/
	function sanitize($data) {
		global $mysql_conn;
		$data = trim($data);
		if(get_magic_quotes_gpc()) {
			$data = stripslashes($data);
		}
		$data = mysql_real_escape_string($data,$mysql_conn);
		return $data;
	}
	/**
	*function used for new regstration. Inserts into uesr table the login details for the new user
	* @param string $email Email used during registration
	* @param string $pwd password selected during registration
	* @param integer $authlevel user type 
	* @return boolean 
	*/
	function register($email,$pwd,$authlevel = 2) {
		global $mysql_conn;
		$errorFlag = false;
		$errorArray;
		$semail = sanitize($email);
		$hashedemail = sha1($semail);
		$pwd = sha1(md5($hashedemail) . sanitize($pwd));		
		mysql_select_db('movements');
		$result = mysql_query("SELECT email FROM authtable WHERE email = '$email'",$mysql_conn) or die("Error Quering Database");
		if(mysql_num_rows($result) == 0) {
			mysql_query("INSERT INTO authtable VALUES('','$email','$pwd','','','','$authlevel','','','','','')",$mysql_conn) or die("Error Quering Database");	
		}
		else {
			$errorFlag = true;
			$errorArray[] = array("email Already Exists","1");	
		}
		
		if($errorFlag)
			return $errorArray;
		else
			return true;
	}
	/**
	*function to validate email address format
	*@param string $email email to be used for login
	*@return boolean
	*/
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
	/**
	*function used to generate random string of default length 5 to be used as cookie or durong forgot password
	*@param integer $length length of password to be generated
	*@return string
	*/
	function generatePassword($length=5) 
	{
		$vowels = 'aeiouyACEUY';
		$consonants = 'bdghjmnwpqrstvzBDGHJLMNWKPQRSTVWXZ23456789@#$%';
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
	
	/**
	*function used for logging in a user. Also sets session and cookie if user choses to stay logged in
	*@param  string $email email used during login
	*@param  string $pwd password used for login
	*@param  boolean $stayloggedin whether user chose to autoamatically logout on closing the browser etc.
	*@return boolean
	*/
	function login($email,$pwd,$stayloggedin=false)
	{
		global $mysql_conn,$_SESSION,$_SERVER;
		$semail=sanitize($email);
		$hashedemail=sha1($semail);
		$spwd=sha1(md5($hashedemail) . sanitize($pwd));
				$res=mysql_query("SELECT * FROM authtable WHERE email='$email' and password='$spwd' LIMIT 1",$mysql_conn) or die("Error :" . mysql_error());
		if(!$res)
			die('Error quering db!!');
		if(mysql_num_rows($res)!=0)
		{
			$session=generatePassword();
			$cookie="";
			$ip=$_SERVER['REMOTE_ADDR'];
			if(!$stayloggedin)
				$que="UPDATE authtable SET session='$session',ip='$ip' WHERE email='$email'";
			else
			{
				$cookie=generatePassword();
				$que="UPDATE authtable SET session='$session',ip='$ip',cookie='$cookie' WHERE email='$email'";
			}
			$result=mysql_query($que,$mysql_conn);
			if($result)
			{
				$_SESSION['session']=$session;
				$_SESSION['email']=$email;
				$idsel=mysql_fetch_array($res);
				$_SESSION['uid']=$idsel['uid'];
				if($cookie!="")
				{
					setcookie("cookie", $cookie, time()+604800,'/');
					setcookie("email", $email , time()+604800,'/');
				}
				$_GET['login']=0;
				return true;
			}
			else
				die("Error quering db");
		}
		unset($_SESSION['session'],$_SESSION['email']);
		return false;
	}
	/**
	*function used logout a user. unsets cookie and session
	*/
	function logout ()
	{
		global $mysql_conn,$_SESSION,$_SERVER;
		if(isSet($_SESSION['session']) || isSet($_SESSION['email']))
		{
			unset($_SESSION['session'],$_SESSION['email']);
			setcookie("cookie","",time()-3600,'/');
			setcookie("email","",time()-3600,'/');
		}
	}
	/**
	*function used check the login status
	*@return boolean
	*/
	function isLogged() 
	{
		global $mysql_conn,$_SESSION,$_SERVER,$authlevel,$whoami;
		if(isSet($_SESSION['email']) && isSet($_SESSION['session']))
		{
			$email=$_SESSION['email'];
			$session=$_SESSION['session'];
			$ip=$_SERVER['REMOTE_ADDR'];
			$res=mysql_query("SELECT * FROM authtable WHERE email='$email' AND session='$session' AND ip='$ip'",$mysql_conn) or die(mysql_error());
			if(mysql_num_rows($res) != 0)
			{
				$res=mysql_fetch_array($res);
				$authlevel=$res['authlevel'];
				$whoami=$res['email'];
				return true;
			}
		}
		else if(isSet($_COOKIE['cookie']))
		{
			$cookie=$_COOKIE['cookie'];
			$email=$_COOKIE['email'];
			$res=mysql_query("SELECT * FROM authtable WHERE email='$email' & cookie='$cookie'",$mysql_conn);
			if(mysql_num_rows($res) != 0)
			{
				$session=generatePassword();
				$ip=$_SERVER['REMOTE_ADDR'];
				if(mysql_query("UPDATE authtable SET session='$session',ip='$ip' WHERE email='$email'",$mysql_conn))
				{
					$_SESSION['session']=$session;
					$_SESSION['email']=$email;
					$res=mysql_fetch_array($res);
					$authlevel=$res['authentication'];
					$whoami=$res['name'];
					return true;
				}
				else die("error quering database : " . mysql_error());				
			}
		}			
		unset($_SESSION['session'],$_SESSION['email']);
		return false;
	}
	$logged_in=isLogged();
	//redirect if user tries to access pages which require logging in
	if(!$logged_in && basename($_SERVER['PHP_SELF'])!="login.php"){
				header('Location:' . $currpath . 'login.php?redir='.$_SERVER['PHP_SELF']);}
?>
