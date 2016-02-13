<?php
function ultra_css_version(){
	global $wp_version;
	$version = $wp_version;
	if(strlen($version) == 3){
		$version = $version . ".0";
	}
	if(version_compare($version, '4.0.0', '>=')){
		return 'css40';
	}else{
		return '';
	}
}

$GLOBALS['ultra_css_ver'] = ultra_css_version();
?>