$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.edit').on('click', function (e) {
        e.preventDefault();
        let graphicName = '';
        let startTime = '';
        let finishTime = '';
        let graphicId = '';
        graphicId = $(this).parent().parent().find('#graphic-id').val();
        $('#modal-graphic-id').val(graphicId);
        graphicName = $(this).parent().parent().find('.name').text();
        $('#graphic-name').val(graphicName);
        startTime = $(this).parent().parent().find('.start').text();
        if (startTime.length) {
            let startHours = startTime.substr(0, 2);
            let startMinutes = startTime.substr(3, 2);
            $('#start-hour').val(startHours);
            $('#start-minutes').val(startMinutes);
        }
        finishTime = $(this).parent().parent().find('.finish').text();
        if (finishTime.length) {
            let finishHours = finishTime.substr(0, 2);
            let finishMinutes = finishTime.substr(3, 2);
            $('#finish-hour').val(finishHours);
            $('#finish-minutes').val(finishMinutes);
        }
    })

    $('#save-graphic').on('click', function (e) {
        e.preventDefault();
        SaveUpdateGraphic();
    })

    $('#add-graphic').on('click', function (e) {
        e.preventDefault();
        $('#graphic-name').val('');
        $('#start-hour').val('');
        $('#start-minutes').val('');
        $('#finish-hour').val('');
        $('#finish-minutes').val('');
        $('#modal-graphic-id').val('');
    })

    $('.delete').on('click', function (e) {
        e.preventDefault();
        let graphicId = '';
        graphicId = $(this).parent().parent().find('#graphic-id').val();
        $('#delete-modal-graphic-id').val(graphicId);
        let graphicName = $(this).parent().parent().find('.name').text();
        $('#graphic-delete-modal-name').text(graphicName);
    })

    $('#delete-graphic').on('click', function (e) {
        e.preventDefault();
        let graphicId = $('#delete-modal-graphic-id').val();
        DeleteGraphic(graphicId);
    })
})

function SaveUpdateGraphic() {
    let graphicId = $('#modal-graphic-id').val();
    let newName = $('#graphic-name').val();
    let newStartHour = $('#start-hour').val();
    let newStartMinute = $('#start-minutes').val();
    let newFinishHour = $('#finish-hour').val();
    let newFinishMinute = $('#finish-minutes').val();
    if (newName.length && newStartHour.length && newStartMinute.length && newFinishHour.length && newFinishMinute.length) {
        let data = {};
        data['name'] = newName;
        data['newStartHour'] = newStartHour;
        data['newStartMinute'] = newStartMinute;
        data['newFinishHour'] = newFinishHour;
        data['newFinishMinute'] = newFinishMinute;
        if (graphicId.length) {
            data['id'] = graphicId;
            $.ajax({
                type: 'POST',
                url: "/edit",
                data: {
                    data: data
                },
                success: function (data) {
                    if (data == 1) {
                        location.reload();
                    }
                    else {
                        alert('Invalid Time Type')
                        return false;
                    }
                }
            });
        } else {
            $.ajax({
                type: 'POST',
                url: "/create",
                data: {
                    data: data
                },
                success: function (data) {
                    if (data == 1) {
                        location.reload();
                    }
                    else {
                        alert('Invalid Time Type')
                        return false;
                    }
                }
            });
        }
    }
    else {
        alert(' Բոլոր դաշտերը պարտադիր են ։')
        return false;
    }
}

function DeleteGraphic(graphicId) {
    if (graphicId.length) {
        $.ajax({
            type: 'POST',
            url: "/deleteGraphic",
            data: {
                graphicId: graphicId
            },
            success: function (data) {
                if (data == 1) {
                    location.reload();
                }
                else {
                    alert('Something is wrong with server')
                    return false;
                }
            }
        });
    }
}
