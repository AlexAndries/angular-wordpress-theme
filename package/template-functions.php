<?php

/**
 * Created by PhpStorm.
 * User: Alex Andries
 * Date: 10/18/2015
 * Time: 1:55 AM
 */
class TemplateFunctions {

	/**
	 * @var array
	 */
	private $menuHide = array();

	/**
	 * @var array
	 */
	private $subMenuHide = array();

	/**
	 * @type array;
	 */
	private $menuLocations;

	/**
	 * @var array
	 */
	private $support = array();

	public function __construct(){
		$this->menuLocations = get_nav_menu_locations();
		add_action('admin_menu', array($this,
			'removeMenu'), 999);
		add_action('after_setup_theme', array($this, 'theme_support'));
	}

	/**
	 * Return Logo
	 *
	 * @return string
	 */
	public function getHeaderLogo(){
		$logo = get_field('logo', 'options');
		$content = '
            <a href="' . home_url() . '" title="' . get_bloginfo('name') . '">
                <img src="' . $logo['sizes']['large'] . '" width="' . $logo['sizes']['large-width'] . '" height="' . $logo['sizes']['large-height'] . '" alt="' . $logo['title'] . '"/>
            </a>
        ';
		return $content;
	}

	public function getHeaderLogoNoHref($class = null){
		$logo = get_field('logo', 'options');
		$content = '
        <img src="' . $logo['sizes']['large'] . '" class="' . $class . '" width="' . $logo['sizes']['large-width'] . '" height="' . $logo['sizes']['large-height'] . '" alt="' . $logo['title'] . '"/>
        ';
		return $content;
	}

	/**
	 * Print Logo
	 */
	public function showHeaderLogo(){
		echo $this->getHeaderLogo();
	}

	/**
	 * Get Menu
	 *
	 * @param $position
	 *
	 * @return string
	 */
	public function getMenu($position){
		$menu = wp_get_nav_menu_object($this->menuLocations[$position]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$content = '<nav class="' . $menu->slug . '"><ul class="list-unstyled">';
		$menuContent = array();
		$parent = 0;
		foreach($menu_items as $item){
			if($item->menu_item_parent == 0){
				$menuContent[$item->ID] = array('parent' => $item,
					'children' => array());
				$parent = $item->ID;
			}else{
				$menuContent[$parent]['children'][] = $item;
			}
		}
		$uri = $_SERVER['REQUEST_URI'];
		foreach($menuContent as $item){
			$slug = get_post($item['parent']->object_id)->post_name;
			$content .= '<li class="menu-item ' . (!empty($item['children']) ? 'has-submenu' : '') . (strpos($uri, $slug) ? ' current-menu ' : ' ') . ' menu-' . $slug . '">
                <a class="menu-0" href="' . ($item['parent']->url != '#' ? $item['parent']->url : 'javascript:;') . '" >' . $item['parent']->title . '</a>';
			if(!empty($item['children'])){
				$content .= '<div class="submenu"><ul class="list-unstyled">';
				foreach($item['children'] as $small){
					$content .= '<li class="submenu-item menu-' . get_post($small->object_id)->post_name . '">
                                <a class="menu-1" href="' . $small->url . '">' . $small->title . '</a>
                               </li>';
				}
				$content .= '</ul></div>';
			}
			$content .= '</li>';
		}
		$content .= '</ul></nav>';
		return $content;
	}

	/**
	 * Print Menu
	 *
	 * @param $position
	 */
	public function showMenu($position){
		echo $this->getMenu($position);
	}

	/**
	 * Print Copyright
	 */
	public function showCopyright(){
		echo '<div class="copyright">' . get_field('copyright_text', 'options') . '</div>';
	}

	/**
	 * Print Social Media
	 *
	 * @return bool
	 */
	public function showSocial(){
		$social = get_field('social_media', 'options');
		if(!empty($social)){
			$content = '<ul class="list-unstyled">';
			foreach($social as $item){
				$content .= '<li class="each-social" name="' . str_replace('fa-', '', $item['icon']) . '">
                    <a tabindex href="' . $item['url'] . '" target="_new" rel="nofollow"><i class="fa ' . $item['icon'] . '"></i>' . $item['title'] . '</a>
                </li>';
			}
			$content .= '</ul>';
			echo $content;
		}else{
			return false;
		}
		return true;
	}

	/**
	 * Print Contact Info
	 */
	public function showContactInfo(){
		$contact = get_field('contact_info', 'options');
		$content = '<div class="contact-info">' . $contact . '</div>';
		echo $content;
	}

	/**
	 * @param        $post_id
	 * @param string $size
	 *
	 * @return mixed
	 */
	public function getFeaturedImage($post_id, $size = 'medium'){
		$image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
		return $image;
	}

	public function getPageUrl($slug){
		return get_permalink(get_page_by_path($slug));
	}

	/**
	 * @param $slug
	 *
	 * @return $this
	 */
	public function addMenuToHide($slug){
		$this->menuHide[] = $slug;
		return $this;
	}

	/**
	 * @param $page
	 * @param $subPage
	 *
	 * @return $this
	 */
	public function addSubMenuToHide($page, $subPage){
		$this->subMenuHide[] = array('page' => $page,
			'subPage' => $subPage);
		return $this;
	}

	public function removeMenu(){
		if(!empty($this->menuHide)){
			foreach($this->menuHide as $item){
				remove_menu_page($item);
			}
		}
		if(!empty($this->subMenuHide)){
			foreach($this->subMenuHide as $item){
				remove_submenu_page($item['page'], $item['subPage']);
			}
		}
	}

	public function addThemeSupport($item){
		$this->support[] = $item;
		add_theme_support( $item );
	}

	public function theme_support(){
		if(!empty($this->support)){
			foreach($this->support as $item){

			}
		}
	}
}