<?php
/**
 * Header
 */
//global $TF;
?>
<!DOCTYPE HTML>
<html ng-app="wordpressApp">
<head>
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<base href="/">
	<?php wp_head(); ?>
</head>
<body <?php body_class('loading-body'); ?>>
<?php do_action('tracking_hook'); ?>
<?php do_action('loader_body_hook'); ?>