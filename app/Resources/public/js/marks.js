$.fn.form.settings.on = 'blur';

rules = {};

$('.ui.form .lesson-mark').each(function() {
    id = $(this).attr('id');

    rules['mark' + id] = {
        identifier: id,
        rules: [
            {
                type: 'integer[1..20]'
            }
        ]
    }
});

$('.ui.form').form(rules, {
    on: 'blur'
});
