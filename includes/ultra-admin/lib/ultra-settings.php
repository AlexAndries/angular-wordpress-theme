<?php
/* --------------- Admin Settings ---------------- */
//require_once('ultra-menu-settings.php');
function ultra_panel_settings(){
	global $ultraadmin;
	//print_r($ultraadmin);
	ultra_add_option("ultraadmin_plugin_access", "manage_options");
	ultra_add_option("ultraadmin_plugin_page", "show");
	ultra_add_option("ultraadmin_plugin_userid", "");
	ultra_add_option("ultraadmin_menumng_page", "enable");
	ultra_add_option("ultraadmin_admin_menumng_page", "enable");
	ultra_add_option("ultraadmin_admintheme_page", "enable");
	ultra_add_option("ultraadmin_logintheme_page", "enable");
	ultra_add_option("ultraadmin_master_theme", "0");
	$get_menumng_page = ultra_get_option("ultraadmin_menumng_page", "enable");
	$get_admin_menumng_page = ultra_get_option("ultraadmin_admin_menumng_page", "enable");
	$get_admintheme_page = ultra_get_option("ultraadmin_admintheme_page", "enable");
	$get_logintheme_page = ultra_get_option("ultraadmin_logintheme_page", "enable");
	$get_mastertheme_page = ultra_get_option("ultraadmin_master_theme", "0");
	// manageoptions and super admin
	$ultraadmin_permissions = ultra_get_option("ultraadmin_plugin_access", "manage_options");
	if($ultraadmin_permissions == "super_admin" && is_super_admin()){
		$ultraadmin_permissions = 'manage_options';
	}
	// specific user
	$ultraadmin_userid = ultra_get_option("ultraadmin_plugin_userid", "");
	if($ultraadmin_permissions == "specific_user" && $ultraadmin_userid == get_current_user_id()){
		$ultraadmin_permissions = 'read';
	}
	$showtabs = true;
	if(is_multisite() && ultra_network_active()){
		if(!is_main_site()){
			$showtabs = false;
		}
	}


}