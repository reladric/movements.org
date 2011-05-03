<?php
/**
 * This file contains functions used for obtaining information about comments
 * @author SVCE Team
 * @version 1.0
 * @package includes
 */
 /**
 *Returns the number of replies to a given post
 *@param integer $post_id Id of the post
 *@return integer
 */
function findComment($post_id)
{
global $cmt;
$q=mysql_query("SELECT * from needcommenttable where post_id=$post_id");
$cnt=0;
if($q){
while($comment_data=mysql_fetch_assoc($q)){
	$cmt[$cnt++]=new comment($comment_data['comment_id'],$comment_data['post_id'],$comment_data['uid'],$comment_data['content'],$comment_data['date'],$comment_data['time']);
}

}
return $cnt;
}

function findHaveComment($post_id)
{
global $cmt;
$q=mysql_query("SELECT * from havecommenttable where post_id=$post_id");
$cnt=0;
if($q){
while($comment_data=mysql_fetch_assoc($q)){
	$cmt[$cnt++]=new comment($comment_data['comment_id'],$comment_data['post_id'],$comment_data['uid'],$comment_data['content'],$comment_data['date'],$comment_data['time']);
}

}
return $cnt;
}

?>