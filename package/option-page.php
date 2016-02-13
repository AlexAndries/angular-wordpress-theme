<?php
/**
 * Created by Alex A.
 * Project: theme-dev
 * Date: 24/11/2015
 * Time: 05:21 PM
 */
acf_add_options_page(array('page_title' => 'Umami Burger Options',
	'menu_title' => 'Umami Burger Options',
	'menu_slug' => 'theme-general-settings',
	'capability' => 'edit_posts',
	'redirect' => false,
	'position'=>3));
/*acf_add_options_sub_page(array('page_title' => 'Umami Burger SEO',
	'menu_title' => 'Umami Burger SEO',
	'menu_slug' => 'theme-general-settings-seo',
	'capability' => 'edit_posts',
	'redirect' => false,
	'parent_slug'=> 'theme-general-settings'));*/
