/**
 * Created by Alexandru on 2/13/2016.
 */
'use strict';
wordpressApp.factory('API', function($resource) {
	return $resource(ajax_url);
});