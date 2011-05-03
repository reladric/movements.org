<?php
session_start();
//includes required to post a new have
include_once('../user.php');

include_once(SERV_ROOT . 'library/post.php');
include_once(SERV_ROOT . 'library/havepost_lib.php');
//obtain Id of currently logged in user
HTMLHeader();
?>
<link href="<?php echo ROOT; ?>includes/css/menu.css" rel="stylesheet" type="text/css" />
<style>
.error{
 background-color:#FFA6A6;
}
.valid{
  background-color:#ABF8B5;
}
</style>
<script type="text/javascript" src="<?php echo ROOT; ?>includes/js/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>includes/js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo ROOT; ?>includes/js/jquery.ui.datepicker.js"></script>

<script type="text/javascript">
	$(function() {
			$("#datepicker").datepicker();
$('#datepicker').datepicker('option', {dateFormat: "yy-mm-dd"});

	});

</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New have</title>
</head>
<body>
<?php
if(!isset($_POST['postsub'])){

?>
	<?php showheader(); ?>
    <?php showwhoami(); ?>
	<?php include(SERV_ROOT . 'user/menu.php'); ?>
<h3 class="head">Post a new have</h3>
<div id="nwpost">
<form action="havespost.php" method="post" name="New post">
Title:<br/><input type="textbox" size="35" name="title"><span id="tspn"></span><br/>
have Description:<br/><textarea cols="60" rows="25" name="content"></textarea><span id="cspn"></span><br/><br/>
Deadline:<p> <input type="text" id="datepicker" name="dead"><span id="dspn"></span></p>
Points:<br/><input type="textbox" size="3" name="points"><span id="ptspn"></span><br/>
<input type="submit" value="post" name="postsub">
</form>
</div>
<?php }
//if already new post is submitted insert into DB and redirect to have page
else{
 $title=$_POST['title'];
 $cont=$_POST['content'];
 $dead=$_POST['dead'];
 $point=$_POST['points'];
 $query="insert into havestable values('','','".$dead."','".(String)date('Y-m-d')."','".(String)date('H:i:s',time())."','".$uid."','".$point."','".$title."','".$cont."')";
 $r=mysql_query($query);
 if($r){?>
	 <meta http-equiv="REFRESH" content="0;url=haves.php">
 <?php }
}
?>
 <?php showfooter(); ?>
</body>
</html>