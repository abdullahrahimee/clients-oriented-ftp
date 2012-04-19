<?php
/*
Template name:
Gallery

Background modified from: http://www.artofadambetts.com/weblog/2008/05/black-leather-apple-desktop-background/
Delete icon: http://www.iconfinder.com/icondetails/37519/16/can_delete_trash_icon
*/

$ld = 'cftp_template_gallery'; // specify the language domain for this template
include_once('../../templates/common.php'); // include the required functions for every template

$window_title = __('Gallery','cftp_template_gallery');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $user_full_name.' | '.$window_title; ?> | <?php echo SYSTEM_NAME; ?></title>
<link rel="stylesheet" media="all" type="text/css" href="<?php echo $this_template; ?>main.css" />
<link rel="shortcut icon" href="../../favicon.ico" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Sirin+Stencil' rel='stylesheet' type='text/css'>
</head>

<body>

<div id="header">

	<?php if (file_exists('../../img/custom/logo/'.LOGO_FILENAME)) { ?>
		<div id="current_logo">
			<img src="../../includes/thumb.php?src=../img/custom/logo/<?php echo LOGO_FILENAME; ?>&amp;w=<?php echo LOGO_MAX_WIDTH; ?>&amp;type=tlogo" alt="" />
		</div>
	<?php } ?>

	<a href="../../process.php?do=logout" target="_self" id="logout"><?php _e('Logout', 'cftp_admin'); ?></a>
</div>
	
<div id="content">

	<div class="wrapper">

<?php
	$count=mysql_num_rows($sql);
	if (!$count) {
		_e('There are no files.','cftp_template_gallery');
	}
	else {
?>
		<ul class="photo_list">
		<?php
			while($row = mysql_fetch_array($sql)) {
		?>
			<?php
				$pathinfo = pathinfo($row['url']);
				$extension = strtolower($pathinfo['extension']);
				$img_formats = array('gif','jpg','pjpeg','jpeg','png');
				if (in_array($extension,$img_formats)) {
			?>
					<li>
						<h5><?php echo htmlentities($row['filename']); ?></h5>
						<div class="img_prev">
							<a href="../../process.php?do=download&amp;client=<?php echo $this_user; ?>&amp;file=<?php echo $row['url']; ?>" target="_blank">
								<img src="../../includes/thumb.php?src=../upload/<?php echo $this_user; ?>/<?php echo $row['url']; ?>&amp;w=280&amp;gr=1&amp;type=prev&amp;who=<?php echo $this_user; ?>&amp;name=<?php echo $row['url']; ?>" class="thumbnail" alt="" />
							</a>
						</div>
						<div class="img_data">
							<div class="download_link">
								<a href="../../process.php?do=download&amp;client=<?php echo $this_user; ?>&amp;file=<?php echo $row['url']; ?>" target="_blank">
									<?php _e('Download original','cftp_template_gallery'); ?>
								</a>
							</div>
						</div>
					</li>
				<?php
				}
			}
			?>
		</ul>
	<?php
	}
	?>

	</div>
</div>

<?php default_footer_info(); ?>

</body>
</html>
<?php $database->Close(); ?>