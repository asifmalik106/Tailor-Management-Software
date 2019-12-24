<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	  if(!is_null($_SESSION['data']['language'])){
  		include "./lang/".$_SESSION['data']['language'].".php";
		} 
	?>
	<title><?php echo $data['title'];?></title>
	<!-- <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> -->
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,500,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo BASE_URL; ?>asset/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BASE_URL; ?>asset/global/plugins/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BASE_URL; ?>asset/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo BASE_URL; ?>asset/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo BASE_URL; ?>asset/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo BASE_URL; ?>asset/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BASE_URL; ?>asset/layouts/layout/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo BASE_URL; ?>asset/layouts/layout/css/custom.css" rel="stylesheet" type="text/css" />
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.min.css" />
	<?php
		if(isset($data['css'])){
			foreach ($data['css'] as $css) {
				echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"".BASE_URL."asset/".$css."\">";
			}
		}
	?>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>asset/css/custom.css">
	<?php
	if(!is_null($_SESSION['data']['language'])){ ?>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>asset/css/<?php echo $_SESSION['data']['language']; ?>.css">
	<?php } ?>
	
</head>
