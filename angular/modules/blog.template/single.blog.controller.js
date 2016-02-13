/**
 * Created by Alexandru on 2/13/2016.
 */
'use strict';
wordpressApp.controller('SingleBlogCTRL',['$scope','$rootScope','API', function($scope,$rootScope,API){
	console.log('SingleBlogCTRL');
	var data = API.get({
		action:'home_template'
	},function(){
		$rootScope.$emit('head-update', data.head);
		$rootScope.$emit('close-loader', true);
	})
}]);