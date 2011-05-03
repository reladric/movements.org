<?php
session_start();
//includes files to display posts
include_once('../user.php');

include_once(SERV_ROOT . 'library/post.php');
include_once(SERV_ROOT . 'library/needpost_lib.php');
include_once(SERV_ROOT . 'library/comm_lib.php');
include_once(SERV_ROOT . 'library/comment.php');
include_once(SERV_ROOT . 'library/user_lib.php');
HTMLHeader();
?>
<link href="<?php echo ROOT; ?>includes/css/tabs.css" rel="stylesheet" type="text/css" />
<link href="<?php echo ROOT; ?>includes/css/menu.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ROOT; ?>includes/js/tab.js" type="text/javascript" charset="utf-8"></script>
<title>Needs</title>
</head>
<?php
//get uid of currentlylogged in user
global $i,$need;
//Prints the needs which is obtained from DB and currently present in $res associative array
function printtable($res){
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
			$author=printuser(findNeedUser($need[$i]->getPostId()));
			//find number of replies for current need
			$rep=findComment($need[$i]->getPostId(),2);
			echo "<tr>\n";
			echo "<td>Need</td>";
		    echo "<td>".$exp."</td>";
	        echo "<td><a href=\"listneed.php?id=".$need[$i]->getPostId()."\">".$need[$i]->getTitle()."</a></td>";
	        echo "<td><a href=\"listuser.php?id=".$need[$i]->getUid()."\">".$author."</td></a>";
	        echo "<td>".$need[$i]->getPoint()."</td>";
	        echo "<td>".$need[$i]->getDeadline()."</td>";
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

<h2>Needs</h2>
<!--Display form which links to page fo rnew need creation-->
<form id="newpost" action="post.php" method="post" style="float:right" class="button">
<input type="submit" value="New Post">
</form>
<!--Print currentusers points-->
<div id="printpoints">Points:<?php echo printpoints($uid); ?></div>
<ul class="tabs">
    <li><a href="#today_need">Today</a></li>
    <li><a href="#yest_need">Yesterday</a></li>
    <li><a href="#tweek_need">This Week</a></li>
    <li><a href="#tmonth_need">This Month</a></li>
</ul>
<br/>
<br/>
<div id="tab_container">
<!--Display needs posted on today-->
	<div id="today_need" class="tabcontents">
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
	//select all needs crated on given date
	$query="select * from needstable where date='$dt' order by date desc";
	$res=mysql_query($query);
	//print the selected needs
	printtable($res);
		?>
	</table>
	</div>
    <!--Display needs posted yesterday-->
	<div id="yest_need" class="tabcontents">
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
//yesterday needs
$dt=date('Y-m-d');
$dt1=subtractDaysFromToday(1);

$query="select * from needstable where date='$dt1'";
$res=mysql_query($query);
global $need;
//print them
printtable($res);
?>

</table>
</div>
<div id="tweek_need" class="tabcontents">
<!--Display needs posted this week-->
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
//select all needs created between given dates
$query="select * from needstable where date between '$dt1' and '$dt' order by date desc";
$res=mysql_query($query);
//print them
	printtable($res);
?>

</table>
</div>
<!--Display needs posted this month-->
<div id="tmonth_need" class="tabcontents">
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
$query="select * from needstable where date between '$dt1' and '$dt' order by date desc";
$res=mysql_query($query);
	printtable($res);
?>

</table>
</div>
</div>
    <?php showfooter(); ?>
</body>
</html>