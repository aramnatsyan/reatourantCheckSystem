$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#clients').next('div').css('margin-top', '30px');

    $('.edit').on('click', function (e) {
        e.preventDefault();
        $('.client-image-path-for-js-checking').attr('src', 'images\\profile-images\\default-prof-image\\download.png');
        let clientImagePath = '';
        let clientName = '';
        let clientSurname = '';
        let clientId = '';
        let clientIdCardNumber = '';
        clientIdCardNumber = $(this).parent().parent().find('#client-id-card-number').val();
        $('#client-id-number').val(clientIdCardNumber);
        clientId = $(this).parent().parent().find('#client-id').val();
        sendClientIdToSession(clientId)
        clientImagePath = $(this).parent().parent().find('#image-path').val();
        $('.modal-client-id').val(clientId);
        if (clientImagePath.length) {
            $('.client-image-path-for-js-checking').attr('src', clientImagePath);
        }
        clientName = $(this).parent().parent().find('.name').text();
        $('#client-name').val(clientName);
        clientSurname = $(this).parent().parent().find('.surName').text();
        $('#client-surname').val(clientSurname);
    })

    $('.delete-client').on('click', function (e) {
        e.preventDefault();
        let clientId = '';
        clientId = $(this).parent().parent().find('#client-id').val();
        $('#delete-modal-client-id').val(clientId);
        let clientName = $(this).parent().parent().find('.name').text();
        let clientSurname = $(this).parent().parent().find('.surName').text();
        $('#client-delete-modal-name').text(clientName + ' ' + clientSurname);
    })

    $('#delete-client').on('click', function (e) {
        e.preventDefault();
        let clientId = $('#delete-modal-client-id').val();
        DeleteClient(clientId);
    })

    $('#uploadImageEdit').on('click', function (e) {
        // e.preventDefault();
        if ($('#image').val().length == '') {
            alert('Ընտրեք նկարը');
            return false
        }
    })

    $('#add-client').on('click', function (e) {
        e.preventDefault();
        $('#client-name').val('');
        $('#client-surname').val('');
        $('.modal-client-id').val('');
        $('.client-image-path-for-js-checking').attr('src', 'images\\profile-images\\default-prof-image\\download.png');
    })

    $('#save-client').on('click', function (e) {
        e.preventDefault();
        updateClient();
    })

    $('#client-creating-next-step').on('click', function (e) {
        e.preventDefault();
        addClient();
    })

    $('#editClientCardNumber').on('shown.bs.modal', function () {
        $("#client-card-new-swipe").val('');
        $("#client-card-new-swipe").focus();
    })

    $('#addNewClientCardNumber').on('shown.bs.modal', function () {
        $("#new-client-new-card-new-swipe").val('');
        $("#new-client-new-card-new-swipe").focus();
    })

    var typingTimer;                //timer identifier
    var doneTypingInterval = 1000;  //time in ms, 5 second for example
    var $input = $('#client-card-new-swipe');
    var $newInput = $('#new-client-new-card-new-swipe');

    $newInput.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(addClientCardNumber, doneTypingInterval);
    });

    $input.on('keyup', function () {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(editClientCardNumber, doneTypingInterval);
    });

    //on keydown, clear the countdown
    $newInput.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //on keydown, clear the countdown
    $input.on('keydown', function () {
        clearTimeout(typingTimer);
    });

    //user is "finished typing," do something
    function editClientCardNumber() {
        let clientNewCardNumber = $('#client-card-new-swipe').val();
        $('#editClientCardNumber').hide();
        $('#editClientCardNumber').modal('toggle');
        $('#client-id-number').val(clientNewCardNumber);
    }
    //user is "finished typing," do something
    function addClientCardNumber() {
        let clientNewCardNumber = $('#new-client-new-card-new-swipe').val();
        $('#addNewClientCardNumber').hide();
        $('#addNewClientCardNumber').modal('toggle');
        $('#new-client-id-number').val(clientNewCardNumber);
    }
});

function DeleteClient(clientId) {
    if (clientId.length) {
        $.ajax({
            type: 'POST',
            url: "/deleteClient",
            data: {
                clientId: clientId
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

function sendClientIdToSession(clientId) {
    if (clientId.length) {
        $.ajax({
            type: 'POST',
            url: "/session",
            data: {
                clientId: clientId
            },
        });
    }
}

function addClient() {
    let newName = $('#new-client-name').val();
    let newSurname = $('#new-client-surname').val();
    let newIdNumber = $('#new-client-id-number').val();
    let data = {};
    data['name'] = newName;
    data['newSurname'] = newSurname;
    data['newIdNumber'] = newIdNumber;
    $.ajax({
        type: 'POST',
        url: "client/create",
        data: {
            data: data
        },
        success: function (data) {
            if (data == 1) {
                location.reload();
            } else {
                alert('Server Error')
                return false;
            }
        }
    });
}

function updateClient() {
    let clientId = $('.modal-client-id').val();
    let newName = $('#client-name').val();
    let newSurname = $('#client-surname').val();
    let newIdNumber = $('#client-id-number').val();
    if (newName.length && newSurname.length && newIdNumber.length) {
        let data = {};
        data['name'] = newName;
        data['newSurname'] = newSurname;
        data['newIdNumber'] = newIdNumber;
        if (clientId.length) {
            data['id'] = clientId;
            $.ajax({
                type: 'POST',
                url: "/client/edit",
                data: {
                    data: data
                },
                success: function (data) {
                    if (data == 1) {
                        location.reload();
                    } else {
                        alert('Invalid Data')
                        return false;
                    }
                }
            });
        } else {
            alert(' Անհայտ հաճախորդ ։')
            return false;
        }
    } else {
        alert(' Բոլոր դաշտերը պարտադիր են ։')
        return false;
    }
}
