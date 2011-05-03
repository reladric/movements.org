<?php
/**
 * This file contains functions required to obtain information about a user
 * @author SVCE Team
 * @version 1.0
 * @package includes
 */
 /**
 This page requires user class
 */
require("userclass.php");
  /**
  *Returns the userclass object with inormation about user with given id
  *@param integer $uid User ID
  *@return users
  */
function finduser($uid){
	$q=mysql_query("select * from user where uid=$uid"); 
    $userdata=mysql_fetch_assoc($q);
	$u1=new users($userdata['uid'],$userdata['points'],$userdata['firstname'],$userdata['lastname'],$userdata['date'],$userdata['month'],$userdata['year'],$userdata['disp_dob'],$userdata['addr1'],$userdata['addr2'],$userdata['city'],$userdata['state'],$userdata['country'],$userdata['zip'],$userdata['phone'],$userdata['sec_email'],$userdata['nickname'],$userdata['twitter'],$userdata['fb'],$userdata['linkedin']);
	return $u1;	
}
  /**
     *returns nickname of user whose information is present in the given 'users object'
     *@param users $u1 user object
	 *@return string
     */
function printuser($u1){
	return $u1->nickname();
}
  /**
     *Returns the 'user object' corresponding to the user who posted the need with given post id
     *@param integer $post_id Post id given
     *@return users
     */
function findNeedUser($post_id)
{
    $q=mysql_query("select * from user where uid=(SELECT uid from needstable where needId=$post_id)"); 
    $userdata=mysql_fetch_assoc($q);
	$u1=new users($userdata['uid'],$userdata['points'],$userdata['firstname'],$userdata['lastname'],$userdata['date'],$userdata['month'],$userdata['year'],$userdata['disp_dob'],$userdata['addr1'],$userdata['addr2'],$userdata['city'],$userdata['state'],$userdata['country'],$userdata['zip'],$userdata['phone'],$userdata['sec_email'],$userdata['nickname'],$userdata['twitter'],$userdata['fb'],$userdata['linkedin']);
	return $u1;	
}
  /**
     *Returns the 'user object' corresponding to the user who posted the need with given post id
     *@param integer $post_id Post id given
     *@return users
     */
function findHaveUser($post_id)
{
    $q=mysql_query("select * from user where uid=(SELECT uid from havestable where haveId=$post_id)"); 
    $userdata=mysql_fetch_assoc($q);
	$u1=new users($userdata['uid'],$userdata['points'],$userdata['firstname'],$userdata['lastname'],$userdata['date'],$userdata['month'],$userdata['year'],$userdata['disp_dob'],$userdata['addr1'],$userdata['addr2'],$userdata['city'],$userdata['state'],$userdata['country'],$userdata['zip'],$userdata['phone'],$userdata['sec_email'],$userdata['nickname'],$userdata['twitter'],$userdata['fb'],$userdata['linkedin']);
	return $u1;	
}

  /**
     *Returns the 'user object' corresponding to the user who posted the comment with given comment id
     *@param integer $comm_id Comment Id
     *@ret
	 */
function findCommentUser($comm_id)
{
    $user= mysql_query("select * from usertable where uid=(SELECT uid from NeedCommentTable where comment_id= $comm_id)");
	if($user)
	$userdata = mysql_fetch_assoc($user);
	echo $userdata['uid'];
	$u1=new users($userdata['uid'],$userdata['points'],$userdata['firstname'],$userdata['lastname'],$userdata['date'],$userdata['month'],$userdata['year'],$userdata['disp_dob'],$userdata['addr1'],$userdata['addr2'],$userdata['city'],$userdata['state'],$userdata['country'],$userdata['zip'],$userdata['phone'],$userdata['sec_email'],$userdata['nickname'],$userdata['twitter'],$userdata['fb'],$userdata['linkedin']);
	return $u1;
}

  /**
     *Returns the 'user object' corresponding to the user who posted the comment with given comment id
     *@param integer $comm_id Comment Id
     *@ret
	 */
function findHaveCommentUser($comm_id)
{
    $user= mysql_query("select * from usertable where uid=(SELECT uid from HaveCommentTable where comment_id= $comm_id)");
	if($user)
	$userdata = mysql_fetch_assoc($user);
	echo $userdata['uid'];
	$u1=new users($userdata['uid'],$userdata['points'],$userdata['firstname'],$userdata['lastname'],$userdata['date'],$userdata['month'],$userdata['year'],$userdata['disp_dob'],$userdata['addr1'],$userdata['addr2'],$userdata['city'],$userdata['state'],$userdata['country'],$userdata['zip'],$userdata['phone'],$userdata['sec_email'],$userdata['nickname'],$userdata['twitter'],$userdata['fb'],$userdata['linkedin']);
	return $u1;
}
  /**
     *Returns the points of given user
     *@param integer $uid User ID
     *@return integer
	 */
function printpoints($uid){
	$q=mysql_query("SELECT * FROM user WHERE uid=$uid") or die("Error Quering Database"); 
    $userdata=mysql_fetch_assoc($q);
	$u1=new users($userdata['uid'],$userdata['points'],$userdata['firstname'],$userdata['lastname'],$userdata['date'],$userdata['month'],$userdata['year'],$userdata['disp_dob'],$userdata['addr1'],$userdata['addr2'],$userdata['city'],$userdata['state'],$userdata['country'],$userdata['zip'],$userdata['phone'],$userdata['sec_email'],$userdata['nickname'],$userdata['twitter'],$userdata['fb'],$userdata['linkedin']);
	return $u1->getPoints();
}
function populatecountry($user){
	$que=mysql_query("SELECT country FROM countrylist");
	while($res = mysql_fetch_array($que)) {
		if($user->getcountry()==$res['country'])
			echo "<option value=\"".$res['country']."\" selected>" . $res['country'] . "</option>";	
		else
			echo "<option value=\"".$res['country']."\">" . $res['country'] . "</option>";	
	}
}
function populatedispdob($user){
	$que=mysql_query("SELECT * FROM dobdisplay");
	while($res = mysql_fetch_array($que)) {
		if($user->getdispdob()==$res['disp_dob'])
			echo "<option value=\"".$res['disp_dob']."\" selected>" . $res['Desc'] . "</option>";	
		else
			echo "<option value=\"".$res['disp_dob']."\">" . $res['Desc'] . "</option>";	
	}
}
function populatedate($user){
			for($i=1;$i<=31;$i++){
		if($user->getdte()==$i)
			echo "<option value=\"".$i."\" selected>" . $i . "</option>";	
		else
			echo "<option value=\"".$i."\">" . $i . "</option>";	
	}
}
function populatemonth($user){
	$month=array(1=>"January",2=>"February",3=>"March",4=>"April",5=>"May",6=>"June",7=>"July",8=>"August",9=>"September",10=>"October",11=>"November",12=>"December");
	for($i=1;$i<=12;$i++){
		if($user->getmonth()==$month[$i])
			echo "<option value=\"".$month[$i]."\" selected>" . $month[$i] . "</option>";	
		else
			echo "<option value=\"".$month[$i]."\">" . $month[$i] . "</option>";	
	}
}
?>