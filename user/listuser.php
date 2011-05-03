<?php
session_start();
include_once('../user.php');
include_once(SERV_ROOT . 'library/user_lib.php');
include_once(SERV_ROOT . 'library/userclass.php');
$user=finduser($_GET['id']);
HTMLHeader();
?>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<title>Profile - <?php echo $user->getfname()." ".$user->getlname()?></title>
</head>
<body>
<?php showheader(); ?>
<?php showwhoami(); ?>
<?php include(SERV_ROOT . 'user/menu.php'); ?>
<div>
<h1 style="text-align:center">Profile Page</h1>
<div id="dispprof">
<form id="dprof" method="post">
First Name:<input type="text" disabled="disabled" value="<?php echo $user->getfname(); ?>" name="fname"/><br/>
Last Name:<input type="text" disabled="disabled" value="<?php echo $user->getlname(); ?>" name="lname"/><br/>
points:<input type="text" disabled="disabled" value="<?php echo $user->getPoints(); ?>" name="points"/><br/>
Dob:<input type="text" disabled="disabled" value="<?php echo $user->getdob(1); ?>" id="datepicker" name="dob"/><br/>
Address Line 1:<input type="text" disabled="disabled" value="<?php echo $user->getaddr1(); ?>" name="addr1"/><br/>
Address Line 2:<input type="text" disabled="disabled" value="<?php echo $user->getaddr2(); ?>" name="addr2"/><br/>
City:<input type="text" disabled="disabled" value="<?php echo $user->getcity(); ?>" name="city"/><br/>
State:<input type="text" disabled="disabled" value="<?php echo $user->getstate(); ?>" name="state"/><br/>
Country:<input type="text" disabled="disabled" name="country" value="<?php echo $user->getcountry();?>"/><br/>
Zip:<input type="text" disabled="disabled" value="<?php echo $user->getzip();?>" name="zip"/><br/>
Phone Number:<input type="text" disabled="disabled" value="<?php echo $user->getPhone(); ?>" name="phone"/><br/>
Secondary Email:<input type="text" disabled="disabled" value="<?php echo $user->getsemail(); ?>" name="semail"/><br/>
NickName:<input type="text" disabled="disabled" value="<?php echo $user->nickname(); ?>" name="nn"/><br/>
Twitter:<input type="text" disabled="disabled" value="<?php echo $user->getTW(); ?>" name="twt"/><br/>
Facebook Username:<input type="text" disabled="disabled" value="<?php echo $user->getFB(); ?>" name="fb"/><br/>
linkedIn:<input type="text" disabled="disabled" value="<?php echo $user->getLN(); ?>" name="ln"/><br/>
</form>
<?php showfooter(); ?>

</div>
</body>
</html>