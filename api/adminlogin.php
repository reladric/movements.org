<?php

// Helper method to get a string description for an HTTP status code
// From http://www.gen-x-design.com/archives/create-a-rest-api-with-php/ 
function getStatusCodeMessage($status)
{
    // these could be stored in a .ini file and loaded
    // via parse_ini_file()... however, this will suffice
    // for an example
    $codes = Array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Higher Security Clearance Required'
    );

    return (isset($codes[$status])) ? $codes[$status] : '';
}

// Helper method to send a HTTP response code/message
function sendResponse($status = 200, $body = '', $content_type = 'text/html')
{
    $status_header = 'HTTP/1.1 ' . $status . ' ' . getStatusCodeMessage($status);
    header($status_header);
    header('Content-type: ' . $content_type);
    echo $body;
}

class checkLoginAPI {
	private $db;
	
	function __construct(){
		$this->db = new mysqli('mysql.arunram.com','sqlmovements','edengroups2011tech','movement_sql');
		$this->db->autocommit(FALSE);
	}
	
	function __destruct(){
		$this->db->close();
	}
	
	function adminLogin(){
		if(isset($_POST["email"]) && isset($_POST["password"]))
		{
			
			//Sanitizing the variables and hashing them for the db
			//$semail=sanitize($_POST["email"]);
			$semail=$_POST['password'];
			$hashedemail=sha1($semail);
			
			//$spwd=sha1(md5($hashedemail) . sanitize($_POST["password"]));
			$spwd=sha1(md5($hashedemail) . ($_POST["password"]));
			
			//Querying the database
			$loginstmt = $this->db->prepare('SELECT auth FROM users WHERE username=? AND password=? LIMIT 1');
			$loginstmt->bind_param("is", $hashedemail, $spwd);
			$loginstmt->execute();
			$loginstmt->bind_result($authLevel);
			while($loginstmt->fetch()){
				break;
			}
			$loginstmt->close();
			
			//checking auth level
			if($authLevel ==2)
			{
				$result = array(
	                authlevel => $authLevel,
	            );
	            sendResponse(200, json_encode($result));
	            return true;
			}
			
			if($authLevel == 1 || $authlevel>=3)
			{
				sendResponse(403, 'Security Clearance Required');
				return false;
			}
			
			if($authLevel <=0)
			{
				sendResponse(400, 'Invalid Credentials');
				return false;
			}
			
			$result = array(
	                authlevel => $authLevel,
	            );
	            sendResponse(200, json_encode($result));
	            return true;
		}
		sendResponse(400, 'Invalid request');
        return false;
	}
}
// This is the first thing that gets called when this page is loaded
// Creates a new instance of the RedeemAPI class and calls the redeem method
$api = new checkLoginAPI;
$api->adminLogin();
unset($_POST["email"]);
unset($_POST["password"]);
?>