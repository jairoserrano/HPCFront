var UIModal = (function(window){

    var $modal;

    var setModal = function(modal){
        $modal = typeof modal !== 'undefined' ? $(modal) : $('#modal');
    };

    var getModal = function(){
        return $modal;
    };

    var showEditModal = function(button, context){
        $(context).on('click', button, function(){
            var $button =  $(this);
            $.get($button.data('url'), function(data){
                $modal.html(data);
                $modal.modal('show');
            });
        });
    };

    var showCreateModal = function(button){
        $(button).on('click', function(){
            var $button =  $(this);
            $.get($button.data('url'), function(data){
                $modal.html(data);
                $modal.modal('show');
            });
        });
    };

    return{
        init:function(modal){
            setModal(modal);
        },

        showCreateModal:showCreateModal,
        showEditModal:showEditModal,
        $modal:getModal
    };
}(window));
