<?php
/**
 * Created by PhpStorm.
 * User: Alexandru
 * Date: 2/13/2016
 * Time: 8:43 PM
 *@note: This is the main page
*/
?>
<!DOCTYPE HTML>
<html ng-app="wordpressApp">
<head ng-controller="GeneralCTRL">
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
	<title ng-bind="headSettings.title"></title>
	<meta name="description" content="{{headSettings.description}}"/>
	<link rel="canonical" href="{{headSettings.canonical}}" />
	<link rel="publisher" href="{{headSettings.publisher}}"/>
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="{{headSettings.facebook.title}}" />
	<meta property="og:description" content="{{headSettings.facebook.description}}" />
	<meta property="og:url" content="{{headSettings.facebook.image}}" />
	<meta property="og:site_name" content="{{headSettings.facebook.site_name}}" />
	<meta name="twitter:card" content="{{headSettings.twitter.card}}"/>
	<meta name="twitter:description" content="{{headSettings.twitter.description}}"/>
	<meta name="twitter:title" content="{{headSettings.twitter.title}}"/>
	<meta name="twitter:site" content="{{headSettings.twitter.site}}"/>
	<meta name="twitter:domain" content="{{headSettings.twitter.domain}}"/>
	<base href="/">
	<?php do_action('header_scripts'); ?>
</head>
<body class="loading-body">
<?php do_action('tracking_hook'); ?>
<?php do_action('loader_body_hook'); ?>
<header>
<a href="/blog/">Blog</a>
</header>
<ng-view></ng-view>
<footer></footer>
<?php do_action('footer_scripts'); ?>
</body>
</html>