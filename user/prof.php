<?php
session_start();
include_once('../user.php');
include_once(SERV_ROOT . 'library/user_lib.php');
include_once(SERV_ROOT . 'library/userclass.php');
$user=finduser($uid);
if(isset($_POST['profupdbut'])){
	$user->updateprofile($_POST['fname'],$_POST['lname'],$_POST['date'],$_POST['month'],$_POST['year'],$_POST['disp_dob'],$_POST['addr1'],$_POST['addr2'],$_POST['city'],$_POST['state'],$_POST['country'],$_POST['zip'],$_POST['phone'],$_POST['semail'],$_POST['nn'],$_POST['twt'],$_POST['fb'],$_POST['ln']);
	header('Location:' . ROOT . 'user/index.php');
}
HTMLHeader();?>
<title>Profile</title>
</head>
<body>
<?php showheader(); ?>
<?php showwhoami(); ?>
<?php include(SERV_ROOT . 'user/menu.php'); ?>
<h1 style="text-align:center">Profile Page</h1>
<div id="prof_form">
<form id="prof" method="post" action="">
Username:<input type="text" disabled="disabled" value="<?php echo $whoami; ?>" name="uname"/><br/>
points:<input type="text" disabled="disabled" value="<?php echo $user->getPoints(); ?>" name="points"/><br/>
First Name:<input type="text"  value="<?php echo $user->getfname(); ?>" name="fname"/><br/>
Last Name:<input type="text"  value="<?php echo $user->getlname(); ?>" name="lname"/><br/>
Date Of Birth : Date:<select name="date"><?php populatedate($user);?></select>
Month:<select name="month"><?php populatemonth($user);?></select>
Year:<input type="text" value="<?php echo $user->getyear(); ?>" name="year" size="4"/><br/>
Display Dob:<select name="disp_dob">
<?php populatedispdob($user);?>
</select><br/>
Address Line 1:<input type="text" value="<?php echo $user->getaddr1(); ?>" name="addr1"/><br/>
Address Line 2:<input type="text" value="<?php echo $user->getaddr2(); ?>" name="addr2"/><br/>
City:<input type="text" value="<?php echo $user->getcity(); ?>" name="city"/><br/>
State:<input type="text" value="<?php echo $user->getstate(); ?>" name="state"/><br/>
Country:<select name="country">
<?php populatecountry($user);?>
</select><br/>
Zip:<input type="text" value="<?php echo $user->getzip();?>" name="zip"/><br/>
Phone Number:<input type="text" value="<?php echo $user->getPhone(); ?>" name="phone"/><br/>
Secondary Email:<input type="text" value="<?php echo $user->getsemail(); ?>" name="semail"/><br/>
NickName:<input type="text" value="<?php echo $user->nickname(); ?>" name="nn"/><br/>
Twitter:<input type="text" value="<?php echo $user->getTW(); ?>" name="twt"/><br/>
Facebook Username:<input type="text" value="<?php echo $user->getFB(); ?>" name="fb"/><br/>
linkedIn:<input type="text" value="<?php echo $user->getLN(); ?>" name="ln"/><br/>
<input type="submit" value="update" name="profupdbut">
</form>
</div>

<?php showfooter(); ?>

</body>
</html>