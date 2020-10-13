$(function(){
    $.loadingModal = {
        init: function() {
            $("body").append("<div id='modal-loading'></div>");
            $.loadingModal.obj = $('#modal-loading');
        },
        show: function() {
            $.loadingModal.obj.addClass('modal');
        },
        hide: function() {
            $.loadingModal.obj.removeClass('modal');
        }
    };    
    $.loadingModal.init();
});