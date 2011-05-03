<?php
session_start();
//includes files to display posts
include_once('../user.php');

include_once(SERV_ROOT . 'library/post.php');
include_once(SERV_ROOT . 'library/havepost_lib.php');
include_once(SERV_ROOT . 'library/comm_lib.php');
include_once(SERV_ROOT . 'library/comment.php');
include_once(SERV_ROOT . 'library/user_lib.php');
HTMLHeader();
?>
<link href="<?php echo ROOT; ?>includes/css/tabs.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ROOT; ?>includes/css/menu.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ROOT; ?>includes/js/tab.js" type="text/javascript" charset="utf-8"></script>
<title>have</title>
</head>
<?php
//get uid of currentlylogged in user
global $i,$have;
//Prints the have which is obtained from DB and currently present in $res associative array
function printtable($res){
	$i=0;
	if($res){
		while ($row = mysql_fetch_assoc($res)) {
			//create a new instance of have class for all have
			$have[$i]=new post($row['haveId'],$row['categId'],$row['deadline'],$row['date'],$row['time'],$row['uid'],$row['point'],$row['title'],$row['content']);	
			//determine whehter or not the have is active
			if((strtotime($have[$i]->getDeadline()))<(strtotime(date('Y-m-d'))))
				$exp="inactive";
			else
				$exp="active";
			//find have author
			$author=printuser(findHaveUser($have[$i]->getPostId()));
			//find number of replies for current have
			$rep=findHaveComment($have[$i]->getPostId(),2);
			echo "<tr>\n";
			echo "<td>have</td>";
		    echo "<td>".$exp."</td>";
	        echo "<td><a href=\"listhave.php?id=".$have[$i]->getPostId()."\">".$have[$i]->getTitle()."</a></td>";
	        echo "<td><a href=\"listuser.php?id=".$have[$i]->getUid()."\">".$author."</td></a>";
	        echo "<td>".$have[$i]->getPoint()."</td>";
	        echo "<td>".$have[$i]->getDeadline()."</td>";
	        echo "<td>Views</td>";
	        echo "<td>".$rep."</td>";
			echo "</tr>\n";
			$i++;
			$exp="";
		}
	}

}
//subtract some number of days from todays data and return resulting date
function subtractDaysFromToday($number_of_days)
{
    $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $subtract = $today - (86400 * $number_of_days);
    return date("Y-m-d", $subtract);
}
?>
<body>
	<?php showheader(); ?>
    <?php showwhoami(); ?>
	<?php include(SERV_ROOT . 'user/menu.php'); ?>

<h2>have</h2>
<!--Display form which links to page fo rnew have creation-->
<form id="newpost" action="havespost.php" method="post" style="float:right" class="button">
<input type="submit" value="New Post">
</form>
<!--Print currentusers points-->
<div id="printpoints">Points:<?php echo printpoints($uid); ?></div>
<ul class="tabs">
    <li><a href="#today_have">Today</a></li>
    <li><a href="#yest_have">Yesterday</a></li>
    <li><a href="#tweek_have">This Week</a></li>
    <li><a href="#tmonth_have">This Month</a></li>
</ul>
<br/>
<br/>
<div id="tab_container">
<!--Display have posted on today-->
	<div id="today_have" class="tabcontents">
	<?php //if(mysql_num_rows($res)!=0){?>
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
	$dt=date('Y-m-d');
	//select all have crated on given date
	$query="select * from havestable where date='$dt' order by date desc";
	$res=mysql_query($query);
	//print the selected have
	printtable($res);
		?>
	</table>
	</div>
    <!--Display have posted yesterday-->
	<div id="yest_have" class="tabcontents">
	<?php //if(mysql_num_rows($res)!=0){?>
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
//yesterday have
$dt=date('Y-m-d');
$dt1=subtractDaysFromToday(1);

$query="select * from havestable where date='$dt1'";
$res=mysql_query($query);
global $have;
//print them
printtable($res);
?>

</table>
</div>
<div id="tweek_have" class="tabcontents">
<!--Display have posted this week-->
<?php //if(mysql_num_rows($res)!=0){?>
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
$dt=date('Y-m-d');
$dt1=subtractDaysFromToday(7);
//select all have created between given dates
$query="select * from havestable where date between '$dt1' and '$dt' order by date desc";
$res=mysql_query($query);
//print them
	printtable($res);
?>

</table>
</div>
<!--Display have posted this month-->
<div id="tmonth_have" class="tabcontents">
<?php //if(mysql_num_rows($res)!=0){?>
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
$dt=date('Y-m-d');
$dt1=subtractDaysFromToday(30);
$query="select * from havestable where date between '$dt1' and '$dt' order by date desc";
$res=mysql_query($query);
	printtable($res);
?>

</table>
</div>
</div>
    <?php showfooter(); ?>
</body>
</html>