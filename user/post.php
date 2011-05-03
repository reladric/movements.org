<?php
session_start();
include_once('../user.php');

include_once(SERV_ROOT . 'library/post.php');
include_once(SERV_ROOT . 'library/needpost_lib.php');

$messBool = false;
if(isset($_POST['postsub'])){
	$post = new post(0,0,sanitize($_POST['dead']),date('Y-m-d'),date('H:i:s',time()),$uid,sanitize($_POST['points']),sanitize($_POST['title']),sanitize($_POST['content']));
	$result = createNeed($post);
	if($result) {
		header('Location:need.php');
		die();
	}
	else {
		$errMsg = "Post creation failed";
		$messBool = true;
	}
}

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
<title>New Need</title>
</head>
<body>
	<?php showheader(); ?>
	<?php showwhoami(); ?>
	<?php include(SERV_ROOT . 'user/menu.php'); ?>

	<?php if(isset($errMsg)) echo '<div id="error">' . $errMsg . '</div>'; ?>
	<h3>Post a new need</h3>
	<div id="nwpost">
		<form action="post.php" method="post" name="nwpost">
        	<table class="form-table">
                <tr>
                    <td>Title : </td>
                    <td><input type="textbox" size="35" name="title" <?php if($messBool) echo 'value="' . sanitize($_POST['title']) . '"'; ?>></td>
                    <td><span id="tspn"></span></td>
                </tr>
                <tr>
                    <td>Need Description : </td>
                    <td><textarea cols="60" rows="25" name="content"><?php if($messBool) echo sanitize($_POST['content']); ?></textarea></td>
                    <td><span id="cspn"></span></td>
                </tr>
                <tr>
                    <td>Deadline : </td>
                    <td><input type="text" id="datepicker" name="dead" <?php if($messBool) echo 'value="' . sanitize($_POST['dead']) . '"'; ?>></td>
                    <td><span id="dspn"></span></td>
                </tr>
                <tr>
                    <td>Points : </td>
                    <td><input type="textbox" size="3" name="points" <?php if($messBool) echo 'value="' . sanitize($_POST['points']) . '"'; ?>></td>
                    <td><span id="ptspn"></span></td>
                </tr>
           </table>
		<input type="submit" value="Submit" name="postsub">
		</form>
	</div>
	<?php showfooter(); ?>
</body>
</html>