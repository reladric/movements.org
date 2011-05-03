<?php 
/* Include Authentication Script */
include_once('user.php') ;
switch($authlevel)
{
	case 3 : break;
	case 2 : header('Location:' . ROOT . 'user/');
			die();
	case 1 : header('Location:' . ROOT . 'admin/');
			die();
	default :
		die("You are nobody. You may <a href=\"login.php?login=2\">Logout</a>");
}
?>
<title>Inner Page</title>
</head>
<body>
	<?php showheader(); ?>
    <?php showwhoami(); ?>
	This is the inner secret page. Your auth level is  : <?php echo $authlevel; ?>,

    <?php showfooter(); ?>
</body>
</html>
