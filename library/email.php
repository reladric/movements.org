<?php
/**
 * This file contains code required to verify whether email address is already registered
 * @author SVCE Team
 * @version 1.0
 * @package includes
 */
 /**
 Include DB connectivity code
 */
include_once('db_conn_admin.php');
mysql_select_db("movements",$mysql_conn);
$email = $_POST['email'];
if(!isset($email))
	die("Error, Invalid Post");
$result = mysql_query("SELECT * FROM authtable WHERE email = '$email'",$mysql_conn);
if(mysql_num_rows($result) > 0)
	echo "0";
else
	echo "1";
?>