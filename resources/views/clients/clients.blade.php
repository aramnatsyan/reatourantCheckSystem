<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CheckInCanteen</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href={{asset('bootstrap/bootstrap.min.css')}}>
    <link rel="stylesheet" href={{asset('fontawesome/css/all.css')}} rel="stylesheet">

    <!-- Fonts -->
    <link href={{asset('fonts/fonts.css')}} rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{asset('home-page/css/home-style.css')}}">
    <link rel="stylesheet" href="{{asset('clients/css/clients-style.css')}}">

    <!-- jQuery -->
    <script src="{{asset('jquery/jquery-3.5.1.js')}}"></script>

    <!-- jQuery Modal -->
    <script src={{asset('jquery/ajax-lib/jquery.min.js')}}></script>
    <script src={{asset('jquery/ajax-lib/popper.min.js')}}></script>
    <script src={{asset('jquery/ajax-lib/bootstrap.min.js')}}></script>

    <!-- Custom Scripts -->
    <script src="{{asset('clients/js/logs-page.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
</head>
<body class="antialiased  mb-5">
@include('menu.header-menu')
<div class="container">
    <div id="home-page-name">
        <h3 style="display: inline-block">
            Հաճախորդներ
        </h3>
        <button id="add-client" style="float: right" type="button" class="btn btn-info btn-lg" data-toggle="modal"
                data-target="#add-client-modal">Ավելացնել
        </button>
    </div>
    <hr>
    <table id="clients">
        <tr>
            <th>Նկար</th>
            <th>Անուն</th>
            <th>Ազգանուն</th>
            <th>Փոփոխել</th>
        </tr>
        @foreach($clients as $client)
            <tr id="client_{{$client['id']}}">
                <input id="client-id" type="hidden" value="{{$client['id']}}">
                <input id="client-id-card-number" type="hidden" value="{{$client['id_card_number']}}">
                <input id="image-path" type="hidden" value="{{$client['picture_path']}}">
                <td>
                    <img
                        @if(file_exists($client['picture_path'])) {
                        src="{{$client['picture_path']}}"
                        }
                        @else {
                        src=" {{asset('images\profile-images\default-prof-image\download.png')}}"
                        }
                        @endif
                        alt="" width="50px">
                </td>
                <td class="name">{{$client['name']}}</td>
                <td class="surName">{{$client['surname']}}</td>
                <td style="width: 5%">
                    <i class="fa fa-edit options edit" data-toggle="modal" data-target="#myModal"></i>
                    <i class="fa fa-trash ml-4 options delete-client" data-toggle="modal" data-target="#delModal"></i>
                </td>
            </tr>
        @endforeach
    </table>
    <div>
        {{ $clients->links() }}
    </div>

    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div id="modal-dialog" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <input class="modal-client-id" type="hidden" value="">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                <!-- Modal body -->
                    <div class="modal-profile-body">
                        <div class="modal-header col-md-3 float-left modal-image-and-button">
                            <div class="">
                                <img class="client-image-path-for-js-checking" src="" alt="" width="200px">
                                <button class="btn btn-dark mt-3" data-toggle="modal" data-target="#imageEditModal">
                                    Փոփոխել
                                </button>
                            </div>
                        </div>
                        <div class="modal-body col-md-8 float-left ml-5 align-content-center">
                            <div class="mt-3">
                                <label for="appt" class="col-md-4">Անուն:</label>
                                <input class="modal-title" id="client-name" value="">
                            </div>
                            <div class="mt-3">
                                <label for="appt" class="col-md-4">Ազգանուն:</label>
                                <input class="modal-title" id="client-surname" value="">
                            </div>
                            <div class="mt-3">
                                <label for="appt" class="col-md-4">ID:</label>
                                <input class="modal-title" id="client-id-number" value="" readonly>
                                <button id="edit-client-card-number" type="button" class="btn btn-dark" data-toggle="modal" data-target="#editClientCardNumber">Մուտքագրել
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button id="save-client" type="button" class="btn btn-success" data-dismiss="modal">Պահպանել
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Չեղարկել</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="delModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <input id="delete-modal-client-id" type="hidden" value="">
                        <h3>Ցանկանում եք հեռացնե՞լ </h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-header">
                        <h3 id="client-delete-modal-name"></h3>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button id="delete-client" type="button" class="btn btn-success" data-dismiss="modal">Այո
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Ոչ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="editClientCardNumber">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <input class="modal-client-id" type="hidden" value="">
                        <h3>Խնդրում ենք անցկացնել քարտը</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-header modal-image-and-button pt-2 pb-2">
                        <div class="prof-pic">
                            <img class="" src="{{asset('images/swipe-card-animation/swipe_card_animation.gif')}}" alt="" width="300px">
                        </div>
                    </div>
                    <div class="modal-content modal-image-and-button">
                        <div class="mt-5 mb-5 pt-5 pb-5">
                            <input id="client-card-new-swipe" type="text" style="width: 90%" autofocus>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="addNewClientCardNumber" style="z-index: 9999;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h3>Խնդրում ենք անցկացնել քարտը</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-header modal-image-and-button pt-2 pb-2">
                        <div class="prof-pic">
                            <img class="" src="{{asset('images/swipe-card-animation/swipe_card_animation.gif')}}" alt="" width="300px">
                        </div>
                    </div>
                    <div class="modal-content modal-image-and-button">
                        <div class="mt-5 mb-5 pt-5 pb-5">
                            <input id="new-client-new-card-new-swipe" type="text" style="width: 90%" autofocus>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="imageEditModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <input class="modal-client-id" type="hidden" value="">
                        <h3>Նկարի փոփոխություն</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-header modal-image-and-button">
                        <div class="prof-pic">
                            <img class="client-image-path-for-js-checking" src="" alt="" width="300px">
                            <div class="ml-1">
                                <form id="submitImageChange" class="m-2" method="post" action="{!! route('profileAvatar') !!}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input id="image" type="file" name="avatar" value="Ընտրել">
                                    </div>
                                    <button id="uploadImageEdit" type="submit" class="btn btn-dark d-block w-75 mx-auto">Բեռնել</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="add-client-modal">
            <div id="modal-dialog" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Նոր հաճախորդ</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-profile-body">
                        <div class="modal-body col-md-8 float-left ml-5 align-content-center">
                            <div class="mt-3">
                                <label for="appt" class="col-md-4">Անուն:</label>
                                <input class="modal-title" id="new-client-name" value="">
                            </div>
                            <div class="mt-3">
                                <label for="appt" class="col-md-4">Ազգանուն:</label>
                                <input class="modal-title" id="new-client-surname" value="">
                            </div>
                            <div class="mt-3">
                                <label for="appt" class="col-md-4">ID:</label>
                                <input class="modal-title" id="new-client-id-number" value="" readonly>
                                <button id="add-new-client-card-number" type="button" class="btn btn-dark" data-toggle="modal" data-target="#addNewClientCardNumber">Մուտքագրել
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button id="client-creating-next-step" type="button" class="btn btn-success" data-dismiss="modal">Պահմանել
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Չեղարկել</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>
