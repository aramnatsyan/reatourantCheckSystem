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
    <link rel="stylesheet" href="{{asset('home-page/css/home-style.css')}}">

    <!-- jQuery -->
    <script src="{{asset('jquery/jquery-3.5.1.js')}}"></script>

    <!-- jQuery Modal -->
    <script src={{asset('jquery/ajax-lib/jquery.min.js')}}></script>
    <script src={{asset('jquery/ajax-lib/popper.min.js')}}></script>
    <script src={{asset('jquery/ajax-lib/bootstrap.min.js')}}></script>

    <!-- Custom Scripts -->
    <script src="{{asset('home-page/js/home-js.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
</head>
<body class="antialiased mb-5">
@include('menu.header-menu')
<div class="container">
    <div id="home-page-name">
        <h3 style="display: inline-block">
            Գլխավոր
        </h3>
    </div>
    <hr>

    <div class="container">
        <div class="text-center" id="lastEnteredClient">
            <div class="modal-dialog home-modal-dialog modal-lg">
                <div class="modal-content home-modal-dialog">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <input class="" type="hidden" value="">
                        <h3>
                            @if(!empty($lastEnteredClient['name']) && !empty($lastEnteredClient['surname']))
                                {{$lastEnteredClient['name'].' '.''.$lastEnteredClient['surname']}}
                            @else
                                {{'Անուն Ազգանուն    '}}
                            @endif
                        </h3>
                    </div>
                    <div class="modal-header modal-image-and-button pt-2 pb-2">
                        <div class="prof-pic">
                            @if(!empty($lastEnteredClient['picture_path']) && file_exists($lastEnteredClient['picture_path']))
                            <img class="" src="{{asset($lastEnteredClient['picture_path'])}}" alt=""
                                 width="300px">
                            @else
                                <img class="" src="{{asset('images\profile-images\default-prof-image\download.png')}}" alt=""
                                     width="300px">
                            @endif
                        </div>
                    </div>
                    <div class="modal-content home-modal-dialog modal-image-and-button">
                        <div class="mt-2 mb-2">
                            <span style="color: red" class="mb-2">Վերջին այցելություն</span>
                            <br>
                            <label for="appt" class="">Ամսաթիվ:</label>
                            <span id="client-last-enter" type="text" style="width: 90%">{{$lastEnterDay}}</span>
                            <br>
                            <label for="appt" class="">Տեսակ:</label>
                            <span id="client-last-enter" type="text" style="width: 90%">{{$graphic}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- The Modal -->
        <div class="text-center" id="checkClientCard">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <input class="" type="hidden" value="">
                        <h3>Խնդրում ենք անցկացնել քարտը</h3>
                    </div>
                    <div class="modal-header modal-image-and-button pt-2 pb-2">
                        <div class="prof-pic">
                            <img class="" src="{{asset('images/swipe-card-animation/swipe_card_animation.gif')}}" alt=""
                                 width="300px">
                        </div>
                    </div>
                    <div class="modal-content modal-image-and-button">
                        <div class="mt-5 mb-5 pt-5 pb-5">
                            <span style="color: red">Եթե պատուհանը ակտիվ չէ, ակտիվացրեք այն: Համակարգչի լեզուն ՝ անգլերեն։</span>
                            <input id="client-card-check-swipe" type="text" style="width: 90%" autofocus>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <i id="enter-closed" class="fa fa-trash ml-4 options hidden" data-toggle="modal" data-target="#enterClosed"></i>
    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="enterClosed">
            <div class="modal-dialog modal-dialogs">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <input id="delete-modal-graphic-id" type="hidden" value="">
                        <h3>Հաճախորդը արդեն օգտվել է ընթացիկ գրաֆիկից</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-header massage-images-error-or-success" style="text-align: center">
                        <img style="" src="{{'images/enterence-images/error.jpg'}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <i id="graphic-error" class="fa fa-trash ml-4 options hidden" data-toggle="modal" data-target="#graphicError"></i>
    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="graphicError">
            <div class="modal-dialog modal-dialogs">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <input id="delete-modal-graphic-id" type="hidden" value="">
                        <h3>Չի հաջողվել ճշգրտել գրաֆիկը, խնդրում ենք ստուգել գրաֆիկները</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-header">
                        <h3 id="graphic-delete-modal-name"></h3>
                    </div>
                    <div class="modal-header massage-images-error-or-success" style="text-align: center">
                        <img style="" src="{{'images/enterence-images/error.jpg'}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <i id="unknown-client" class="fa fa-trash ml-4 options hidden" data-toggle="modal" data-target="#unknownClient"></i>
    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="unknownClient">
            <div class="modal-dialog modal-dialogs">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="text-align: center">
                        <input id="delete-modal-graphic-id" type="hidden" value="">
                        <h3 style="width: 100%">Անհայտ հաճախորդ</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-header massage-images-error-or-success" style="text-align: center">
                        <img style="" src="{{'images/enterence-images/error.jpg'}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <i id="client-can-use" class="fa fa-trash ml-4 options hidden" data-toggle="modal"
       data-target="#clientCanEnter"></i>
    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="clientCanEnter">
            <div class="modal-dialog modal-dialogs">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <input id="graphic-id" type="hidden" value="">
                        <input id="graphic-id" type="hidden" value="">
                        <h3>Մուտքն ազատ է</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-header massage-images-error-or-success" style="text-align: center">
                        <img style="" src="{{'images/enterence-images/success.jpg'}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="error-sound" style="display: none">
        <source src={{asset('sounds/error.mp3')}} type="audio/mpeg">
    </audio>

    <audio id="success-sound" style="display: none">
        <source src={{asset('sounds/success.mp3')}} type="audio/mpeg">
    </audio>
</div>
</body>
</html>
