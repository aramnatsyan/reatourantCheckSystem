$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#clients').next('div').css('margin-top', '30px');

    $('.delete-log').on('click', function (e) {
        e.preventDefault();
        let logId = '';
        logId = $(this).parent().parent().find('#log-id').val();
        $('#delete-modal-log-id').val(logId);
    })

    $('#delete-log').on('click', function (e) {
        e.preventDefault();
        let logId = $('#delete-modal-log-id').val();
        DeleteLog(logId);
    })
});

function DeleteLog(logId) {
    if (logId.length) {
        $.ajax({
            type: 'POST',
            url: "/deleteLog",
            data: {
                logId: logId
            },
            success: function (data) {
                if (data == 1) {
                    location.reload();
                } else {
                    alert('Something is wrong with server')
                    return false;
                }
            }
        });
    }
}
