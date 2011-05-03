<?php
session_start();
include_once('../user.php');
//Post Id to which reply is going to be posted
$pid=$_GET['postid'];
HTMLHeader();
?>
<title>Reply</title>
</head>
<body>
<?php showheader(); ?>
<?php showwhoami(); ?>
<?php include(SERV_ROOT . 'user/menu.php'); ?>
<?php 
//show reply form(if not already reply is submitted)
if(!isset($_POST['repsub'])){
?>

<h3 class="head">Post a reply</h3>
<div id="nwpost">
<form action="reply.php" method="post" name="nwpost" class="button">
Reply:<br/><textarea cols="60" rows="25" name="content"></textarea><span id="cspn"></span><br/><br/>
<?php echo "<input type=\"hidden\" value=\"$pid\" name=\"postid\">"?>
<input type="submit" value="post" name="repsub">

</form>
</div>
<?php }
//Insert reply post ito DB and redirect
else{
 $cont=$_POST['content'];
 $pid=$_POST['postid'];
 $query="insert into needcommenttable values('','".$pid."','".$uid."','".$cont."','".date('Y-m-d')."','".date('H:i:s',time())."')";
 $r=mysql_query($query);
 if($r){
	 echo "<meta http-equiv=\"REFRESH\" content=\"0;url=listneed.php?id=$pid\">";
 }
}?>
    <?php showfooter(); ?>
</body>
</html>