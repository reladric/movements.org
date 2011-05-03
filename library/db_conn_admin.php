<?php 
/**
 * This file contains DB connectivity code
 * @author SVCE Team
 * @version 1.0
 * @package includes
 */
$host="localhost";
$password="";
$username="root";
$mysql_conn = mysql_connect("$host","$username","$password");
if (!$mysql_conn)
	die('Could not connect: ' . mysql_error());
mysql_select_db('movements',$mysql_conn);
?>
