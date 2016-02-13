/**
 * Created by Alexandru on 2/13/2016.
 */
'use strict';
wordpressApp.controller('GeneralCTRL',['$scope','$rootScope', function($scope,$rootScope){
	$scope.headSettings = {};
	$rootScope.$on('head-update', function(event, data) {
		$scope.headSettings = data;
	});
}]);