<?php
/**
 * Define constants
 */
define('THEME_URL', get_theme_root_uri() . '/standard-theme/');
define('THEME_URL_BOWER', get_theme_root_uri() . '/standard-theme/bower_components/');
/**
 * Include custom fields
 */
require_once('includes/custom-fields-pro/custom-fields.php');
/**
 * include custom option
 */
require_once('package/option-page.php');
/**
 * Template Functions Include
 */
require_once('package/template-functions.php');
$TF = new TemplateFunctions();
/**
 * Ultra Admin Theme
 */
require_once('includes/ultra-admin/ultra-core.php');
/**
 * Include visual composer
 */
if(get_field('use_vc', 'options')){
	require_once('includes/visual-composer/js_composer.php');
	global $vc_manager;
	$vc_manager = new Vc_Manager();
}
/**
 * Include custom post types
 * Include menu register locations
 */
require_once('package/custom-post-type.php');
require_once('package/menu-register-locations.php');
/**
 * Register Menus
 */
$menus = new MenuLocations();
$menus->addMenu(array('primary-menu' => 'Main Menu'))
	->addMenu(array('mobile-menu' => 'Mobile Menu'))
	->addMenu(array('footer-menu' => 'Footer Menu'))
	->addMenu(array('footer-mobile-menu' => 'Footer Mobile Menu'))
	->registerMenus();
/**
 * Include scripts and styles
 */
require_once('package/enqueue-scripts.php');
$scriptsFooter = new EnqueueScripts(true);
$scriptsFooter->addStyle('font-awesome', THEME_URL . 'includes/font-awesome/css/font-awesome.min.css')
	->addStyle('bootstrap', THEME_URL_BOWER . 'bootstrap/dist/css/bootstrap.min.css')
	->addStyle('main', THEME_URL . 'css/main.css')
	->addScript('preloader', 'http://code.createjs.com/createjs-2013.12.12.min.js')
	->addScript('jQuery', THEME_URL_BOWER . 'jquery/dist/jquery.min.js')
	->addScript('main', THEME_URL . 'js/main.js');
/**
 * Remove Query String from Static Resources
 */
function remove_cssjs_ver($src){
	if(strpos($src, '?ver='))
		$src = remove_query_arg('ver', $src);
	return $src;
}

add_filter('style_loader_src', 'remove_cssjs_ver', 10, 2);
add_filter('script_loader_src', 'remove_cssjs_ver', 10, 2);
/**
 * Hide editor Menu
 */
$TF->addSubMenuToHide('themes.php', 'theme-editor.php')
	->addSubMenuToHide('plugins.php', 'plugin-editor.php')
	->addMenuToHide('edit-comments.php')
	->addMenuToHide('edit.php');
/**
 * Seo Alt tag for images
 *
 * @param $string
 *
 * @return string
 */
function create_SEO_alt($string){
	$strings = str_split($string);
	$alt = "";
	$up = true;
	$first = true;
	foreach($strings as $e){
		if(preg_match('/[^a-zA-Z]/', $e)){
			$alt .= "";
			$up = true;
		}else{
			if($up){
				if($first){
					$first = false;
					$alt .= strtoupper($e);
				}else{
					$alt .= ' ' . strtoupper($e);
				}
				$up = false;
			}else{
				$alt .= $e;
			}
		}
	}
	return $alt;
}

add_action('tracking_hook', 'load_tracking_scripts');
function load_tracking_scripts(){
	the_field('ga_code', 'options');
	the_field('pixels_code', 'options');
}

if(get_field('loader', 'options')){
	add_action('header_scripts', 'loader_header', 1);
	function loader_header(){
		?>
		<script>
			var loadingImages = [];
		</script>
		<?php
	}

	add_action('footer_scripts', 'loader_footer', 99999);
	function loader_footer(){
		?>
		<script>
			var queue = new createjs.LoadQueue();
			queue.on("complete", doneLoader, this);
			queue.on("progress", loadingEvent, this);
			queue.loadManifest(loadingImages);
		</script>
		<?php
	}

	add_action('loader_body_hook', 'loader_content');
	function loader_content(){
		$logo = get_field('loader_logo', 'options');
		$logoFade = get_field('loader_logo_fade', 'options');
		?>
		<div ng-controller="LoaderCTRL">
			<style>
				<?php
				include ('css/loader.css');
				?>
			</style>
			<div ng-class="showLoader?'loader-section':'loader-section close-loader'" class="loader-section"
			     style="background-color:<?php the_field('loader_background_color', 'options') ?>">
				<div class="loader-center">
					<img src="<?php echo $logoFade['url'] ?>" height="<?php echo $logoFade['height'] ?>"
					     width="<?php echo $logoFade['width'] ?>" class="img-responsive"
					     alt="<?php bloginfo('name') ?>">
					<div class="loader-effect">
						<img src="<?php echo $logo['url'] ?>" height="<?php echo $logo['height'] ?>"
						     width="<?php echo $logo['width'] ?>" class="img-responsive"
						     alt="<?php bloginfo('name') ?>">
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
add_action('header_scripts', 'general_javascript_variables', 1);
function general_javascript_variables(){
	?>
	<script>
		var site_url = "<?php echo home_url(); ?>",
			ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>
	<?php
}

/**
 * Load angular scripts (Footer)
 */
$angularScripts = new EnqueueScripts(true);
$angularScripts
	->addStyle('angular-material', THEME_URL_BOWER . 'angular-material/angular-material.min.css')
	->addStyle('html5-boilerplate-normalize', THEME_URL_BOWER . 'html5-boilerplate/dist/css/normalize.css')
	->addStyle('html5-boilerplate-main', THEME_URL_BOWER . 'html5-boilerplate/dist/css/main.css')
	->addStyle('angular-bootstrap', THEME_URL_BOWER . 'angular-bootstrap/ui-bootstrap-csp.css')
	->addStyle('angular-loading-bar', THEME_URL_BOWER . 'angular-loading-bar/build/loading-bar.min.css')
	->addScript('angular', THEME_URL_BOWER . 'angular/angular.min.js')
	->addScript('angular-arie', THEME_URL_BOWER . 'angular-aria/angular-aria.min.js')
	->addScript('angular-animate', THEME_URL_BOWER . 'angular-animate/angular-animate.min.js')
	->addScript('angular-resource', THEME_URL_BOWER . 'angular-resource/angular-resource.min.js')
	->addScript('angular-material', THEME_URL_BOWER . 'angular-material/angular-material.min.js')
	->addScript('angular-messages', THEME_URL_BOWER . 'angular-messages/angular-messages.min.js')
	->addScript('angular-cookies', THEME_URL_BOWER . 'angular-cookies/angular-cookies.min.js')
	->addScript('angular-loading-bar', THEME_URL_BOWER . 'angular-loading-bar/build/loading-bar.min.js')
	->addScript('angular-route', THEME_URL_BOWER . 'angular-route/angular-route.min.js')
	->addScript('angular-bootstrap', THEME_URL_BOWER . 'angular-bootstrap/ui-bootstrap-tpls.min.js')
	->addScript('html5-boilerplate', THEME_URL_BOWER . 'html5-boilerplate/dist/js/vendor/modernizr-2.8.3.min.js')
	->addScript('ngstorage', THEME_URL_BOWER . 'ngstorage/ngStorage.min.js')
	->addScript('angular-app', THEME_URL . 'angular/app.js')
	->addScript('angular-config', THEME_URL . 'angular/config.js')
	->addScript('angular-services', THEME_URL . 'angular/services.js')
	->addScript('angular-general-controller', THEME_URL . 'angular/modules/general.functions/general.controller.js')
	->addScript('angular-loader-controller', THEME_URL . 'angular/modules/general.functions/loader.controller.js')
	->addScript('angular-home-template-page', THEME_URL . 'angular/modules/home.template/home.template.controller.js')
	->addScript('angular-single-page-template-page', THEME_URL . 'angular/modules/page.template/single.page.controller.js')
	->addScript('angular-single-blog-template-page', THEME_URL . 'angular/modules/blog.template/single.blog.controller.js');
/**
 * Load API
 * @note
 * You'll have to create an API for each template/post type (single / taxonomy)
 * please add documentation for each API
 */
require_once('api/autoload.php');
$APIs = new AngularAPIs();
$APIs->addAPI('home.template')
	->addAPI('menu.template')
	->registerAPIs()
	->addFunctions('generate-head-json')
	->registerFunctions();
/**
 * preload images functionality
 * @param $imageID
 * @param $imageSRC
 */
function preload_image($imageSRC){
	?>
	<script>
		loadingImages.push({
			src: "<?php echo $imageSRC ?>"
		});
	</script>
	<?php
}

/**
 * Umami Burger Functionality
 */
/**
 * Theme Support
 */
$TF->addThemeSupport('post-thumbnails');
/**
 * Blog Post Type
 */
$blog = new CPT(array(
	'post_type_name' => 'blog',
	'singular' => 'Blog Post',
	'plural' => 'Blog Posts',
	'slug' => 'blog'
), array('supports' => array('thumbnail', 'title', 'editor')));
$blog->menu_icon('dashicons-clipboard');
$blog->register_taxonomy(array(
	'taxonomy_name' => 'blog-categories',
	'singular' => 'Category',
	'plural' => 'Categories',
	'slug' => 'categories'
));
$blog->register_taxonomy('tag', array(), false);
/**
 * Locations Post Type
 */
$location = new CPT(array(
	'post_type_name' => 'location',
	'singular' => 'Location',
	'plural' => 'Locations',
	'slug' => 'locations'
), array('supports' => array('thumbnail')));
$location->menu_icon('dashicons-palmtree');
$location->register_taxonomy(array(
	'taxonomy_name' => 'ca',
	'singular' => 'California Region',
	'plural' => 'CA Regions',
	'slug' => 'ca'
));
$location->register_taxonomy(array(
	'taxonomy_name' => 'il',
	'singular' => 'Illinois Region',
	'plural' => 'IL Regions',
	'slug' => 'il'
));
$location->register_taxonomy(array(
	'taxonomy_name' => 'nv',
	'singular' => 'Nevada Region',
	'plural' => 'NV Regions',
	'slug' => 'nv'
));
$location->register_taxonomy(array(
	'taxonomy_name' => 'ny',
	'singular' => 'New York Region',
	'plural' => 'NY Regions',
	'slug' => 'ny'
));
/**
 * Menu Post Type
 */
$menuFood = new CPT(array(
	'post_type_name' => 'menu',
	'singular' => 'Menu Item',
	'plural' => 'Menu Items',
	'slug' => 'menu'
), array('supports' => array('thumbnail', 'title')));
$menuFood->menu_icon('dashicons-list-view');
$menuFood->register_taxonomy(array(
	'taxonomy_name' => 'menu-categories',
	'singular' => 'Menu Category',
	'plural' => 'Menu Categories',
	'slug' => 'categories'
));
/**
 * Press Post Type
 */
$press = new CPT(array(
	'post_type_name' => 'press',
	'singular' => 'Press Item',
	'plural' => 'Press Items',
	'slug' => 'press'
));
$press->menu_icon('dashicons-megaphone');
/**
 * Instagram Posts
 */
$instagram = new CPT(array(
	'post_type_name' => 'instagram',
	'singular' => 'Instagram Item',
	'plural' => 'Instagram Items',
	'slug' => 'instagram'
));
$instagram->menu_icon('dashicons-images-alt2');
$TF->addSubMenuToHide('edit.php?post_type=instagram', 'post-new.php?post_type=instagram');