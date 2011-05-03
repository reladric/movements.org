<?php 
session_start();
include_once('user.php');
if(!$logged_in && isset($_POST['uname'],$_POST['pass']))
	$login=login($_POST['uname'],$_POST['pass'],$_POST['loggedin']);
if(isSet($_GET['redir'])) $url=$_GET['redir'];
else $url="index.php";
if($_GET['login']==2) logout();

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link href="<?php echo ROOT; ?>includes/css/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php if(!$logged_in) {
			if(!isset($_POST['uname']) || !isset($_POST['pass'])) { ?>
			<h2>Admin Login</h2>
				<div id="login-box">
					<form id="login" name="login" method="post" action="login.php">
					<?php if($_GET['login']==1)	{ ?>
						<span class="status"><?php echo "Incorrect username/password"; ?></span>
							<?php  } ?>
						<table id="login-table">
							<tr>
								<td>Username : </td>
								<td><input type="text" name="uname" id="uname" class="text" /></td>
							</tr>
							<tr>
								<td>Password : </td>
								<td><input type="password" name="pass" id="pass" class="text" /></td>
							</tr>
							<tr>
								<td>Remember me : </td>
								<td class="box"><input name="loggedin" type="checkbox" value="" checked /></td>
							</tr>
							<tr>
								<td colspan="2"></td>
						</table>
						<input name="submit" type="submit" value="Login"/>
					</form>
				</div>
				&copy; Sri Venkateswara College of Engineering
		<?php } else {
					if($login)
					{
						?>
<meta http-equiv="refresh" content="0;URL=<?php echo $url; ?>"/>
						<?php
					}
					else
					{
						?>
						<meta http-equiv="refresh" content="0;URL=login.php?login=1"/>
						<?php
					}
				}
			}
			else
			{
				?>
				<meta http-equiv="refresh" content="0;URL=<?php echo $url; ?>"/>
				<?php
			}
			?>

</body>
</html>
