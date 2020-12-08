$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;  //time in ms, 5 second for example
    var $input = $('#client-card-check-swipe');

    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(checkClientCardNumber, doneTypingInterval);
    });

    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    function checkClientCardNumber() {
        let clientCardNumber = $input.val();
        $input.val('');
        $.ajax({
            type: 'POST',
            url: "/checkClientEnter",
            data: {
                clientCardNumber: clientCardNumber
            },
            success: function (data) {
                let res = JSON.parse(data);
                if (res.message == 'Client not exists!') {
                    $('audio#error-sound')[0].play();
                    $('#unknown-client').click();
                } else if (res.message == 'Can`t find graphics') {
                    $('audio#error-sound')[0].play();
                    $('#graphic-error').click();
                } else if (res.message == 'Client is already entered') {
                    $('audio#error-sound')[0].play();
                    $('#enter-closed').click();
                } else if (res.message == 'Enter is Open') {
                    $('#client-can-use').click();
                    $('audio#success-sound')[0].play();
                    let clientId = res.clientId;
                    let graphicId = res.graphicId;
                    addClientActivityToLogs(clientId, graphicId);
                } else {
                    alert('Server Error');

                }
                setTimeout(function () {
                    location.reload();
                }, 3000)
            }
        });
    }

    function addClientActivityToLogs(clientId, graphicId) {
        $.ajax({
            type: 'POST',
            url: "/addClientActivityToLogs",
            data: {
                clientId: clientId,
                graphicId: graphicId
            },
            success: function (data) {

            }
        });
    }
})
