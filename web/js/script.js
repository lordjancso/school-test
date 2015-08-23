$(function () {
    $('input[name="students[]"]').on('change', function () {
        var id = $(this).val();

        if ($(this).is(':checked')) {
            addId(id);
        } else {
            if ($('#all_students').is(':checked')) {
                $('#all_students').prop('checked', false);
            }

            removeId(id);
        }
    });

    $('#filter input').on('change', function () {
        $(this).closest('form').submit();
    });

    $('#all_students').on('change', function () {
        var type = 'uncheck';
        if ($(this).is(':checked')) {
            type = 'check';
        }

        $.each($('input[name="students[]"]'), function (key, item) {
            var checked = false;
            var id = $(item).val();

            if (type == 'check') {
                checked = true;
                addId(id);
            } else {
                removeId(id);
            }

            $(item).prop('checked', checked);
        });
    });

    function removeId(id) {
        var ids = $('#delete_form input').val().split(',');

        ids = $.grep(ids, function (value) {
            return value != id;
        });

        $('#delete_form input').val(ids.join(','));
    }

    function addId(id) {
        var ids = $('#delete_form input').val().split(',');

        if ($.inArray(id, ids) == -1) {
            ids.push(id);
        }

        $('#delete_form input').val(ids.join(','));
    }
});