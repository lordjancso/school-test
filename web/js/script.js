$(function () {
    $('input[name="students[]"]').on('change', function () {
        var ids_input = $('#delete_form input');
        var ids = ids_input.val().split(',');
        var id = $(this).val();

        if ($(this).is(':checked')) {
            ids.push(id);
        } else {
            ids = $.grep(ids, function (value) {
                return value != id;
            });
        }

        ids_input.val(ids.join(','));
    });

    $('#filter input').on('change', function () {
        $(this).closest('form').submit();
    });
});