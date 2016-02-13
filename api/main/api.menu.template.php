<?php
/**
 * API for menu page template
 * Created by PhpStorm.
 * User: Alexandru
 * Date: 2/13/2016
 * Time: 12:56 PM
 * @todo Documentation for this API
 */
add_action( 'wp_ajax_menu_template', 'menu_template_api' );
add_action( 'wp_ajax_nopriv_menu_template', 'menu_template_api' );
function menu_template_api(){

	wp_die();
}