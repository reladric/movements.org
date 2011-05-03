<?php session_start();
//includes required to list the need
include_once('../user.php');

include_once(SERV_ROOT . 'library/needpost_lib.php');
include_once(SERV_ROOT . 'library/post.php');
include_once(SERV_ROOT . 'library/comm_lib.php');
include_once(SERV_ROOT . 'library/comment.php');
include_once(SERV_ROOT . 'library/user_lib.php');
//obtain id of need which is going to be listed
$id=$_GET['id'];
//obtian need information from DB
$query1="select * from needstable where needId=$id";
$r=mysql_query($query1);
$need=mysql_fetch_assoc($r);
//create a new instance of post class with data about current need obatined from DB
$p=new post($need['needId'],$need['categId'],$need['deadline'],$need['date'],$need['time'],$need['uid'],$need['point'],$need['title'],$need['content']);
global $cmt,$usr;
//Obtain number of replies for current user. Also all replies are obtained in form of comment class object referenced by global $cmt array
$num=findComment($id);
HTMLHeader();
?>
<link href="<?php echo ROOT; ?>includes/css/tabs.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ROOT; ?>includes/css/menu.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ROOT; ?>includes/js/tab.js" type="text/javascript" charset="utf-8"></script>
<style>
#need{
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
<title>Need -  <?php echo $p->getTitle()?></title>
</head>
<?php

?>
<body>
	<?php showheader(); ?>
    <?php showwhoami(); ?>
	<?php include(SERV_ROOT . 'user/menu.php'); ?>
<?php 
// form which contains button linking to reply page
echo "<form action=\"reply.php\" method=\"get\">";
echo "<input type=\"hidden\" value=\"$id\" name=\"postid\">"?>
<input type="submit" value="reply">
</form>

<div id="user">
<?php 
//print current need author's nickname
echo printuser(findNeedUser($id));
?>
</div>
<div id="need">
<!--Print The need details-->
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