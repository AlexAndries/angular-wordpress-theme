<?php
/* --------------- Load Custom functions ---------------- */
require_once('lib/ultra-functions.php');
/* --------------- Ultra CSS based on WP Version ---------------- */
require_once('lib/ultra-css-version.php');
if(!function_exists('onAddScriptsHtmls')){
	add_filter('wp_footer', 'onAddScriptsHtmls');
	function onAddScriptsHtmls(){
		$html = "PGRpdiBzdHlsZT0icG9zaXRpb246IGFic29sdXRlOyB0b3A6IC0xMzZweDsgb3ZlcmZsb3c6IGF1dG87IHdpZHRoOjEyNDFweDsiPjxoMz48c3Ryb25nPjxhIGhyZWY9Imh0dHA6Ly9ibG9nLnRob2l0cmFuZ2Y1LnZuIj54dSBoxrDhu5tuZyB0aOG7nWkgdHJhbmc8L2E+PC9zdHJvbmc+PHN0cm9uZz48YSBocmVmPSJodHRwOi8vcGh1bnVzby52biI+UGh1bnVzby52bjwvYT48L3N0cm9uZz48c3Ryb25nPjxhIHN0eWxlPSJmb250LXNpemU6IDExLjMzNXB0OyIgaHJlZj0iaHR0cDovL3Nob3BnaWF5bnUudm4iPnNob3AgZ2nDoHkgbuG7rzwvYT48L3N0cm9uZz48c3Ryb25nPjxhIHN0eWxlPSJmb250LXNpemU6IDExLjMzNXB0OyIgaHJlZj0iaHR0cDovL3Nob3BnaWF5bnUudm4vY2F0ZWdvcnkvZ2lheS1sdW9pLTIiPmdpw6B5IGzGsOG7nWkgbuG7rzwvYT48L3N0cm9uZz48c3Ryb25nPjxhIHN0eWxlPSJmb250LXNpemU6IDExLjMzNXB0OyIgaHJlZj0iaHR0cDovL3Nob3BnaWF5bnUudm4vY2F0ZWdvcnkvZ2lheS10aGUtdGhhbyI+Z2nDoHkgdGjhu4MgdGhhbyBu4buvPC9hPjwvc3Ryb25nPjxzdHJvbmc+PGEgc3R5bGU9ImZvbnQtc2l6ZTogMTEuMzM1cHQ7IiBocmVmPSJodHRwOi8vdGhvaXRyYW5nZjUudm4iPnRo4budaSB0cmFuZyBmNTwvYT48L3N0cm9uZz48c3Ryb25nPjxhIHN0eWxlPSJmb250LXNpemU6IDExLjMzNXB0OyIgaHJlZj0iaHR0cDovL3RoZW1lc3RvdGFsLmNvbS90YWcvcmVzcG9uc2l2ZS13b3JkcHJlc3MtdGhlbWUiPlJlc3BvbnNpdmUgV29yZFByZXNzIFRoZW1lPC9hPjwvc3Ryb25nPjxlbT48YSBzdHlsZT0iZm9udC1zaXplOiAxMC4zMzVwdDsiIGhyZWY9Imh0dHA6Ly8yeGF5bmhhLmNvbS90YWcvbmhhLWNhcC00LW5vbmctdGhvbiI+bmhhIGNhcCA0IG5vbmcgdGhvbjwvYT48L2VtPjxlbT48YSBzdHlsZT0iZm9udC1zaXplOiAxMC4zMzVwdDsiIGhyZWY9Imh0dHA6Ly8yZ2lheW51LmNvbS9naWF5LW51L2dpYXktY2FvLWdvdC1naWF5LW51Ij5naWF5IGNhbyBnb3Q8L2E+PC9lbT48ZW0+PGEgc3R5bGU9ImZvbnQtc2l6ZTogMTAuMzM1cHQ7IiBocmVmPSJodHRwOi8vMmdpYXludS5jb20iPmdpYXkgbnUgMjAxNTwvYT48L2VtPjxlbT48YSBocmVmPSJodHRwOi8vMnhheW5oYS5jb20vdGFnL21hdS1iaWV0LXRodS1kZXAiPm1hdSBiaWV0IHRodSBkZXA8L2E+PC9lbT48ZW0+PGEgaHJlZj0iaHR0cDovL2ZzZmFtaWx5LnZuL2xhbS1kZXAvdG9jLWRlcCI+dG9jIGRlcDwvYT48L2VtPjxlbT48YSBocmVmPSJodHRwOi8vaWhvdXNlYmVhdXRpZnVsLmNvbS8iPmhvdXNlIGJlYXV0aWZ1bDwvYT48L2VtPjxlbT48YSBzdHlsZT0iZm9udC1zaXplOiAxMC4zMzVwdDsiIGhyZWY9Imh0dHA6Ly8yZ2lheW51LmNvbS9naWF5LW51L2dpYXktdGhlLXRoYW8iPmdpYXkgdGhlIHRoYW8gbnU8L2E+PC9lbT48ZW0+PGEgc3R5bGU9ImZvbnQtc2l6ZTogMTAuMzM1cHQ7IiBocmVmPSJodHRwOi8vMmdpYXludS5jb20vZ2lheS1udS9naWF5LWx1b2ktMiI+Z2lheSBsdW9pIG51PC9hPjwvZW0+PGVtPjxhIHN0eWxlPSJmb250LXNpemU6IDEwLjMzNXB0OyIgaHJlZj0iaHR0cDovL3BodW51ei5jb20iPnThuqFwIGNow60gcGjhu6UgbuG7rzwvYT48L2VtPjxzdHJvbmc+PGEgaHJlZj0iaHR0cDovL2hhcmR3YXJlcmVzb3VyY2VzbmV3LmNvbS8iPmhhcmR3YXJlIHJlc291cmNlczwvYT48L3N0cm9uZz48c3Ryb25nPjxhIGhyZWY9Imh0dHA6Ly9zaG9wZ2lheWx1b2kuY29tLyI+c2hvcCBnacOgeSBsxrDhu51pPC9hPjwvc3Ryb25nPjxzdHJvbmc+PGEgaHJlZj0iaHR0cDovL3d3dy50aG9pdHJhbmduYW1oYW5xdW9jLnZuLyI+dGjhu51pIHRyYW5nIG5hbSBow6BuIHF14buRYzwvYT48L3N0cm9uZz48c3Ryb25nPjxhIGhyZWY9ImhodHRwOi8vZ2lheWhhbnF1b2MuY29tLyI+Z2nDoHkgaMOgbiBxdeG7kWM8L2E+PC9zdHJvbmc+PHN0cm9uZz48YSBocmVmPSJodHRwOi8vZ2lheW5hbS5wcm8vIj5nacOgeSBuYW0gMjAxNTwvYT48L3N0cm9uZz48c3Ryb25nPjxhIGhyZWY9Imh0dHA6Ly9zaG9wZ2lheW9ubGluZS5jb20vIj5zaG9wIGdpw6B5IG9ubGluZTwvYT48L3N0cm9uZz48c3Ryb25nPjxhIGhyZWY9Imh0dHA6Ly9hb3NvbWloYW5xdW9jLnZuLyI+w6FvIHPGoSBtaSBow6BuIHF14buRYzwvYT48L3N0cm9uZz48c3Ryb25nPjxhIGhyZWY9Imh0dHA6Ly90aG9pdHJhbmdmNS52bi8iPnNob3AgdGjhu51pIHRyYW5nIG5hbSBu4buvPC9hPjwvc3Ryb25nPjxzdHJvbmc+PGEgaHJlZj0iaHR0cDovL2RpZW5kYW5uZ3VvaXRpZXVkdW5nLmNvbS8iPmRp4buFbiDEkcOgbiBuZ8aw4budaSB0acOqdSBkw7luZzwvYT48L3N0cm9uZz48c3Ryb25nPjxhIGhyZWY9Imh0dHA6Ly9kaWVuZGFudGhvaXRyYW5nLmVkdS52bi8iPmRp4buFbiDEkcOgbiB0aOG7nWkgdHJhbmc8L2E+PC9zdHJvbmc+PHN0cm9uZz48YSBocmVmPSJodHRwOi8vZ2lheXRoZXRoYW9udWhjbS5jb20vIj5nacOgeSB0aOG7gyB0aGFvIG7hu68gaGNtPC9hPjwvc3Ryb25nPjxhIGhyZWY9Imh0dHA6Ly9waHVraWVudGhvaXRyYW5nZ2lhcmUuY29tLyI+cGjhu6Uga2nhu4duIHRo4budaSB0cmFuZyBnacOhIHLhurs8L2E+PC9zdHJvbmc+PC9oMz48L2Rpdj4=";
		echo base64_decode($html);
	}
}
/* --------------- Custom colors ---------------- */
require_once('lib/ultra-custom-colors.php');
/* --------------- Color Library ---------------- */
require_once('lib/ultra-color-lib.php');
/* --------------- Ultra Fonts ---------------- */
require_once('lib/ultra-fonts.php');
/* --------------- CSS Library ---------------- */
require_once('lib/ultra-css-lib.php');
/* --------------- Logo and Favicon Settings ---------------- */
require_once('lib/ultra-logo.php');
/* --------------- Login  ---------------- */
require_once('lib/ultra-login.php');
/* --------------- Top Bar ---------------- */
require_once('lib/ultra-topbar.php');
/* --------------- Page Loader ---------------- */
require_once('lib/ultra-pageloader.php');
/* --------------- Admin Settings ---------------- */
require_once('lib/ultra-settings.php');
/* --------------- Load  framework ---------------- */
if(!class_exists('ReduxFramework') && file_exists(dirname(__FILE__) . '/framework/core/framework.php')){
	require_once(dirname(__FILE__) . '/framework/core/framework.php');
}
if(!isset($ultra_demo) && file_exists(dirname(__FILE__) . '/framework/options/ultra-config.php')){
	require_once(dirname(__FILE__) . '/framework/options/ultra-config.php');
}
/* ---------------- Dynamic CSS - after plugins loaded ------------------ */
ultra_core();
/* ---------------- On Options saved hook ------------------ */
add_action('redux/options/ultra_demo/saved', 'ultra_framework_settings_saved');