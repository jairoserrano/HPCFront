var UIForm = function () {
    var isAjaxForm = Boolean(false);
    var $form;

    var setForm = function(form, ajax){
        $form = typeof form !== 'undefined' ? $(form) : $('form');
        isAjaxForm = typeof ajax !== 'undefined' ? ajax : false;
    };

    var getForm = function(){
        return $form;
    };

    var validate = function (rules, messages) {
        console.log('vamos a procesar el asunto');
        $form.each(function () {
            $(this).validate({
                rules: rules,
                messages: messages,
                submitHandler: function (form) {
                    var _form = $(form);
                    if (isAjaxForm) {
                        $.ajax({
                            type: _form.prop('method'),
                            url: _form.prop('action'),
                            data: _form.serialize()
                        }).done(function(data) {
                            console.log(data);
                        });
                    } else {
                        console.log('Vamos a enviar el formulario');
                        form.submit();
                    }
                },
                showErrors: function (map, list) {
                    this.currentElements.parents('label:first, div:first').find('.has-error').remove();
                    this.currentElements.parents('.form-group:first').removeClass('has-error');

                    $.each(list, function (index, error) {
                        var ee = $(error.element);
                        var eep = ee.parents('label:first').length ? ee.parents('label:first') : ee.parents('div:first');

                        ee.parents('.form-group:first').addClass('has-error');
                        eep.find('.has-error').remove();
                        eep.append('<p class="has-error help-block">' + error.message + '</p>');
                    });
                }
            });
        });
    };

    return {
        init : function(form, ajax){
            setForm(form, ajax);
            if($(':input[type="file"]').length){
                $form.find(':input[type="file"]').fileinput();
            }
        },
        validate: validate,
        $form:getForm
    }
}();


