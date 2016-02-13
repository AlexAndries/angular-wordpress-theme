/**
 * Created by Alexandru on 2/10/2016.
 */
'use strict';
var wordpressApp = angular
	.module('wordpressApp', [
		'ngCookies',
		'ngRoute',
		'ngResource',
		'ngMaterial',
		'ngMessages',
		'ui.bootstrap',
		'ngStorage',
		'angular-loading-bar'
	])
	.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
		cfpLoadingBarProvider.includeSpinner = false;
	}]);