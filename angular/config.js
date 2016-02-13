/**
 * Created by Alexandru on 2/10/2016.
 */
'use strict';
var themeURL = 'wp-content/themes/standard-theme/angular/';
wordpressApp.config(['$routeProvider','$locationProvider',
	function($routeProvider, $locationProvider){
		$routeProvider.when('/', {
			templateUrl: themeURL+'templates/home.template/home.template.page.html',
			controller: 'HomeTemplatePageCTRL'
		}).when('/blog/:post',{
			templateUrl: themeURL+'templates/blog.template/single.blog.html',
			controller: 'SingleBlogCTRL'
		}).when('/:page',{
			templateUrl: themeURL+'templates/page.template/single.page.html',
			controller: 'SinglePageCTRL'
		}).otherwise({
			redirectTo: '/'
		});
		$locationProvider.html5Mode(true);
	}]);