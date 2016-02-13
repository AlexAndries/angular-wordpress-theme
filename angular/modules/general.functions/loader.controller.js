/**
 * Created by Alexandru on 2/13/2016.
 */
'use strict';
wordpressApp.controller('LoaderCTRL',['$scope','$rootScope', function($scope,$rootScope){
	$scope.showLoader = true;
	$rootScope.$on('close-loader', function(event, data) {
		$scope.showLoader = false;
	});
}]);