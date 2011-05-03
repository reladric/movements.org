<?php
session_start();
include_once('../user.php');
HTMLHeader();
?>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<title>Home</title>
</head>
<body>
<?php showheader(); ?>
<?php showwhoami(); ?>
<?php if(substr($_SERVER['HTTP_REFERER'],16)==ROOT."user/prof.php")
	echo "profile Update complete";
	?>
<?php include(SERV_ROOT . 'user/menu.php'); ?>
<?php showfooter(); ?>
</body>
</html>