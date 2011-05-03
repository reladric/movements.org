<?php session_start();
//includes required to list the have
include_once('../user.php');

include_once(SERV_ROOT . 'library/havepost_lib.php');
include_once(SERV_ROOT . 'library/post.php');
include_once(SERV_ROOT . 'library/comm_lib.php');
include_once(SERV_ROOT . 'library/comment.php');
include_once(SERV_ROOT . 'library/user_lib.php');
//obtain id of have which is going to be listed
$id=$_GET['id'];
//obtian have information from DB
$query1="select * from havestable where haveId=$id";
$r=mysql_query($query1);
$have=mysql_fetch_assoc($r);
//create a new instance of post class with data about current have obatined from DB
$p=new post($have['haveId'],$have['categId'],$have['deadline'],$have['date'],$have['time'],$have['uid'],$have['point'],$have['title'],$have['content']);
global $cmt,$usr;
//Obtain number of replies for current user. Also all replies are obtained in form of comment class object referenced by global $cmt array
$num=findHaveComment($id);

HTMLHeader();
?>
<link href="<?php echo ROOT; ?>includes/css/tabs.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ROOT; ?>includes/css/menu.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ROOT; ?>includes/js/tab.js" type="text/javascript" charset="utf-8"></script>
<style>
#have{
	float:right;
	margin-right:25%;
}
#user{
	margin-left:25%;
	float:left;
}
#reply{
	clear:both;
		margin-left:25%;
}
#replies{
	clear:both;
}
</style>
<title>have - <?php echo $p->getTitle();?></title>
</head>
<body>
	<?php showheader(); ?>
    <?php showwhoami(); ?>
	<?php include(SERV_ROOT . 'user/menu.php'); ?>
<?php 
// form which contains button linking to reply page
echo "<form action=\"replyhave.php\" method=\"get\">";
echo "<input type=\"hidden\" value=\"$id\" name=\"postid\">"?>
<input type="submit" value="reply">
</form>

<div id="user">
<?php 
//print current have author's nickname
echo printuser(findHaveUser($id));
?>
</div>
<div id="have">
<!--Print The have details-->
Title:<?php echo $p->getTitle();?><br/>
Content:<?php echo $p->getContent();?><br/>
Date:<?php echo $p->getDate();?><br/>
</div>
<div id="replies">
Replies:
<?php 
//Print replies as Usernamee  \n  Contetn  \n Date
for($count=0;$count<$num;$count++)
{
	echo "<div class=\"users\">User:".printuser(finduser($cmt[$count]->getUid()))."</div>";
	echo "<div class=\"reply\">Content:".$cmt[$count]->getContent();
	echo "<br/>Date:".$cmt[$count]->getDate()."</div>";
}

?>
</div>
    <?php showfooter(); ?>
</body>
</html>