var App = function($, window){
    return{
        init: function () {
            $('#alternative-menu').live('hover', function(){
                $(this).removeClass('close');
            });
        }
    }
}(jQuery, window);