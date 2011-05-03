<?php 
session_start();
//includes files to display posts
include_once('../user.php');

include_once(SERV_ROOT . 'library/post.php');
include_once(SERV_ROOT . 'library/user_lib.php');
include_once(SERV_ROOT . 'library/comm_lib.php');
include_once(SERV_ROOT . 'library/comment.php');
include_once(SERV_ROOT . 'library/needpost_lib.php');

HTMLHeader();
?>
<link href="<?php echo ROOT; ?>includes/css/tabs.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ROOT; ?>includes/css/menu.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ROOT; ?>includes/js/tab.js" type="text/javascript" charset="utf-8"></script>
<title>My Posts</title>
</head>
<?php
//Prints the needs which is obtained from DB and currently present in $res associative array
function printneedtable($res){
	$i=0;
	if($res){
		while ($row = mysql_fetch_assoc($res)) {
			//create a new instance of need class for all needs
			$need[$i]=new post($row['needId'],$row['categId'],$row['deadline'],$row['date'],$row['time'],$row['uid'],$row['point'],$row['title'],$row['content']);	
			//determine whehter or not the need is active
			if((strtotime($need[$i]->getDeadline()))<(strtotime(date('Y-m-d'))))
				$exp="inactive";
			else
				$exp="active";
			//find needs author
			$author=printuser(findUser($need[$i]->getPostId()));
			//find number of replies for current need
			$rep=findComment($need[$i]->getPostId());
			echo "<tr>\n";
			echo "<td>Need</td>";
		    echo "<td>".$exp."</td>";
	        echo "<td><a href=\"listneed.php?id=".$need[$i]->getPostId()."\">".$need[$i]->getTitle()."</a></td>";
	        echo "<td><a href=\"listuser.php?id=".$need[$i]->getUid()."\">".$author."</td>";
	        echo "<td>".$need[$i]->getPoint()."</td>";
	        echo "<td>".$need[$i]->getDeadline()."</td>";
	        echo "<td>Views</td>";
	        echo "<td>".count($rep)."</td>";
			echo "</tr>\n";
			echo "</a>";
			$i++;
			$exp="";
		}
	}

}
function printhavetable($res){
	$i=0;
	if($res){
		while ($row = mysql_fetch_assoc($res)) {
			//create a new instance of have class for all haves
			$have[$i]=new post($row['haveId'],$row['categId'],$row['deadline'],$row['date'],$row['time'],$row['uid'],$row['point'],$row['title'],$row['content']);	
			//determine whehter or not the have is active
			if((strtotime($have[$i]->getDeadline()))<(strtotime(date('Y-m-d'))))
				$exp="inactive";
			else
				$exp="active";
			//find haves author
			$author=printuser(findUser($have[$i]->getPostId()));
			//find number of replies for current have
			$rep=findComment($have[$i]->getPostId());
			echo "<tr>\n";
			echo "<td>Have</td>";
		    echo "<td>".$exp."</td>";
	        echo "<td><a href=\"listhave.php?id=".$have[$i]->getPostId()."\">".$have[$i]->getTitle()."</a></td>";
	        echo "<td><a href=\"listuser.php?id=".$have[$i]->getUid()."\">".$author."</td>";
	        echo "<td>".$have[$i]->getPoint()."</td>";
	        echo "<td>".$have[$i]->getDeadline()."</td>";
	        echo "<td>Views</td>";
	        echo "<td>".count($rep)."</td>";
			echo "</tr>\n";
			echo "</a>";
			$i++;
			$exp="";
		}
	}

}
?>

<body>
<?php showheader(); ?>
<?php showwhoami(); ?>
<?php include(SERV_ROOT . 'user/menu.php'); ?>
<h2>My Posts</h2>
<ul class="tabs">
    <li><a href="#mneeds">Needs</a></li>
    <li><a href="#mhaves">Haves</a></li>
    <li><a href="#mresps">Responses</a></li>
</ul>
<div id="tab_container">
	<div id="mneeds" class="tabcontents">
	<table cellspacing="2" cellpadding="6">
		<tr><th>Type</th>
		<th>Status</th>
	    <th>Title</th>
    	<th>Author</th>
	    <th>Point</th>
	    <th>Deadline</th>
	    <th>Views</th>
	    <th>Replies</th>
	</tr>
	<?php 
	//select all needs of current user
	$query="select * from needstable where uid=$uid";
	$res=mysql_query($query);
	printneedtable($res);
	?>
    </table>
     </div>
	<div id="mhaves" class="tabcontents">
	<table cellspacing="2" cellpadding="6">
		<tr><th>Type</th>
		<th>Status</th>
	    <th>Title</th>
    	<th>Author</th>
	    <th>Point</th>
	    <th>Deadline</th>
	    <th>Views</th>
	    <th>Replies</th>
	</tr>
	<?php 
	//select all needs of current user
	$query="select * from havestable where uid=$uid";
	$res=mysql_query($query);
	printhavetable($res);
	?>
    </table>
    </div>
    <div id="mresps" class="tabcontents">
    </div>
    </div>
    <?php showfooter(); ?>
</body>
</html>