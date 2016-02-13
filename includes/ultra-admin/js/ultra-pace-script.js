
/*----------------------------------
    Page loader
-----------------------------------*/

(function($) {
    Pace.on('start', function(){
    });
    Pace.on('hide', function(){
    	$("#wpwrap").addClass("loaded");
    });
 })(jQuery);
 
