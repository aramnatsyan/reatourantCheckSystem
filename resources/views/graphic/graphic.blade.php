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
    <link rel="stylesheet" href="{{asset('graphics/css/graphics-style.css')}}">

    <!-- jQuery -->
    <script src="{{asset('jquery/jquery-3.5.1.js')}}"></script>

    <!-- jQuery Modal -->
    <script src={{asset('jquery/ajax-lib/jquery.min.js')}}></script>
    <script src={{asset('jquery/ajax-lib/popper.min.js')}}></script>
    <script src={{asset('jquery/ajax-lib/bootstrap.min.js')}}></script>

    <!-- Custom Scripts -->
    <script src="{{asset('graphics/js/graphics-page.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="antialiased mb-5">
@include('menu.header-menu')
<div class="container">
    <div id="home-page-name">
        <h3 style="display: inline-block">
            Գրաֆիկ
        </h3>
        <button id="add-graphic" style="float: right" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Ավելացնել</button>
    </div>
    <hr>
    <table>
        <tr>
            <th>Անվանում</th>
            <th>Սկիզբ</th>
            <th>Ավարտ</th>
            <th>Փոփոխել</th>
        </tr>
        @foreach($graphics as $graphic)
            <tr id="graphic_{{$graphic['id']}}">
                <input id="graphic-id"  type="hidden" value="{{$graphic['id']}}">
                <td class="name">{{$graphic['graphic_name']}}</td>
                <td class="start">{{$graphic['start_time']}}</td>
                <td class="finish">{{$graphic['finish_time']}}</td>
                <td style="width: 5%">
                    <i class="fa fa-edit options edit" data-toggle="modal" data-target="#myModal"></i>
                    <i class="fa fa-trash ml-4 options delete" data-toggle="modal" data-target="#delModal"></i>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <input id="modal-graphic-id" type="hidden" value="">
                        <label for="appt" class="col-md-4">Անվանում:</label>
                        <input class="modal-title" id="graphic-name" value="">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div>
                            <label for="appt" class="col-md-4">Սկիզբ:</label>
                            <label for="appt" class="">Ժամ:</label>
                            <input type="number" id="start-hour" name="hours" min="0" max="23" value="">
                            <label for="appt" class="">Րոպե:</label>
                            <input type="number" id="start-minutes" name="minutes" min="0" max="59" value="">
                        </div>
                        <div>
                            <label for="appt" class="col-md-4">Ավարտ:</label>
                            <label for="appt" class="">Ժամ:</label>
                            <input type="number" id="finish-hour" name="hours" min="0" max="23" value="">
                            <label for="appt" class="">Րոպե:</label>
                            <input type="number" id="finish-minutes" name="minutes" min="0" max="59" value="">
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button id="save-graphic" type="button" class="btn btn-success" data-dismiss="modal">Պահպանել</button>
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
                        <input id="delete-modal-graphic-id" type="hidden" value="">
                        <h3>Ցանկանում եք հեռացնե՞լ </h3>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-header">
                        <h3 id="graphic-delete-modal-name"></h3>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button id="delete-graphic" type="button" class="btn btn-success" data-dismiss="modal">Այո</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Ոչ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
