<?php 
	/* You cannot access this file directly */
	if(basename($_SERVER['PHP_SELF'])=="functions.php")
		header('Location:../../index.php');
	
	define('ROOT',"/m2/");
function HTMLHeader() {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo ROOT; ?>includes/css/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ROOT; ?>includes/jquery/jquery-1.5.min.js" type="text/javascript" language="javascript"></script>
<script src="<?php echo ROOT; ?>includes/jquery/jquery-ui-1.8.9.custom.min.js" type="text/javascript" language="javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo ROOT; ?>includes/jquery/jquery-ui-1.8.9.custom.css">
<!-- End of Functions Includes -->
<?php 
}

function makedate($id="date") {
?>
					$("#<?php echo $id; ?>").datepicker({dateFormat: 'dd/mm/y',showAnim: 'scale' });
<?php }

function showheader() {
	echo 
	'<div id="container">
		<div id="header">
        </div>';
}

function showwhoami () {
	global $whoami,$logged_in,$prof_complt;
		if($logged_in)  {
			$mess = '<div id="who"><p>You are logged in as ' . $whoami . '. <a href="' . ROOT . 'index.php">Home</a> | <a href="' . ROOT . 'login.php?login=2">Logout</a> <br />';
			if($prof_complt==0)
				$mess=$mess."Complete your <a href='prof.php'> profile.</a>";
			else
				$mess=$mess."View/ Update your <a href='" . ROOT . "user/prof.php'>Profile</a><br />";
			$mess .= "</p></div>";
			echo $mess;
		}
}

function showfooter()
{
	echo '
		<div id="footer">
			Designed and maintained by the Department of Computer Science and Engineering. &copy Sri Venkateswara Collge of Engineering 2010.
	    </div>	
    </div>';
}

function tinymce () // Applies tinymce to all text areas
{
 ?>
 <script src="<?php echo ROOT; ?>includes/tiny_mce/tiny_mce.js" type="text/javascript" language="javascript"></script>
 <script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "center",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		
	// Example content CSS (should be your site CSS)
	content_css : "<?php echo ROOT; ?>includes/tiny_mce/css/content.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "<?php echo ROOT; ?>includes/tiny_mce/lists/template_list.js",
	external_link_list_url : "<?php echo ROOT; ?>includes/tiny_mce/lists/link_list.js",
	external_image_list_url : "<?php echo ROOT; ?>includes/tiny_mce/lists/image_list.js",
	media_external_list_url : "<?php echo ROOT; ?>includes/tiny_mce/lists/media_list.js",


	// Style formats
	style_formats : [
		{title : 'Bold text', inline : 'b'},
		{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
		{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
		{title : 'Example 1', inline : 'span', classes : 'example1'},
		{title : 'Example 2', inline : 'span', classes : 'example2'},
		{title : 'Table styles'},
		{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
	],

	// Replace values for the template plugin
	template_replace_values : {
		username : "Some User",
		staffid : "991234"
	}
});
</script>
<?php
}
?>
