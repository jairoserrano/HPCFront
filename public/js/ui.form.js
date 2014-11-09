var UIForm = function () {
    var isAjaxForm = Boolean(false);
    var $form;

    var setForm = function (form, ajax) {
        $form = typeof form !== 'undefined' ? $(form) : $('form');
        isAjaxForm = typeof ajax !== 'undefined' ? ajax : false;
    };

    var getForm = function () {
        return $form;
    };

    var validate = function (rules, messages) {

        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg != value;
        });

        $.validator.addMethod("alpha", function(value, element) {
            return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
        });

        $form.each(function () {
            $(this).validate({
                rules: rules,
                messages: messages,
                debug: true,
                submitHandler: function (form) {
                    var _form = $(form);
                    if (isAjaxForm) {
                        $.ajax({
                            type: _form.prop('method'),
                            url: _form.prop('action'),
                            data: _form.serialize()
                        }).done(function (data) {
                            console.log(data);
                        });
                    } else {
                        console.log('Vamos a enviar el formulario');
                        form.submit();
                    }
                },
                errorPlacement: function (error, element) {
                    element.closest('.form-group').find('.help-block').html(error.text());
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                success: function (label) {
                    $(label).closest('form').find('.valid').removeClass("invalid");
                }
            });
        });

        $form.data("validator").settings.ignore = "";
    };

    return {
        init: function (form, ajax) {
            setForm(form, ajax);
            var $form = $(form);
            var $inputFile = $form.find(':input[type="file"]');
            var $selects = $form.find('select');


            if ($inputFile.length) {
                $inputFile.fileinput();
            }
            if ($selects.length) {
                $selects.selectpicker();
            }

        },
        validate: validate,
        $form: getForm
    }
}();


