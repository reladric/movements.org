<?php
/**
 * This file contains functions for obtaining information about a post
 * @author SVCE Team
 * @version 1.0.1
 * @package includes
 */
 
  /**
  *Returns a boolean value to indicate whehter a Need is completed or not 
  *@param integer $need_id Postid given
  *@return boolean
  */   
function isComplete($need_id)
{
 
    $q=mysql_query("SELECT need_id from NeedTransactionTable where need_id=$need_id");
    if(mysql_num_rows($q))
    {
        return true;
    }
    else
    return false;
}

function createNeed($post) {
	$pid = ""; $categId = ""; $date = date('Y-m-d'); $time = date('H:i:s',time()); $point = 0; $title = ""; $content = "";
	if($post -> getPostId() != 0)
		$pid = $post -> getPostId();
	if($post -> getCategId() != 0)
		$categId = $post -> getCategId();
		
	if($post -> getDeadline() == NULL) 
		return false;
	else
		$deadline = $post -> getDeadline();
		
	if($post -> getUid() == 0)
		return false;
	else
		$uid = $post -> getUid();
		
	if($post -> getDate() != NULL) 
		$date = $post -> getDate();
	if($post -> getTime() != NULL)
		$time = $post -> getTime();
	if($post -> getPoint() != NULL)
		$point = $post -> getPoint();
	if($post -> getTitle() != NULL)
		$title = $post -> getTitle();
	if($post -> getContent() != NULL)
		$content = $post -> getContent();
		
	$bool = true;
	$query = "INSERT INTO needstable VALUES ('$pid','$categId','$deadline','$date','$time','$uid','$point','$title','$content')";
 	$r = mysql_query($query) or $bool = false;
	return $bool;
}

?>