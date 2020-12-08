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
    <link rel="stylesheet" href="{{asset('logs/css/logs-style.css')}}">

    <!-- jQuery -->
    <script src="{{asset('jquery/jquery-3.5.1.js')}}"></script>

    <!-- jQuery Modal -->
    <script src={{asset('jquery/ajax-lib/jquery.min.js')}}></script>
    <script src={{asset('jquery/ajax-lib/popper.min.js')}}></script>
    <script src={{asset('jquery/ajax-lib/bootstrap.min.js')}}></script>

    <!-- Custom Scripts -->
    <script src="{{asset('logs/js/logs-page.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
</head>
<body class="antialiased  mb-5">
@include('menu.header-menu')
<div class="container">
    <div id="home-page-name">
        <h3 style="display: inline-block">
            Ընդհանուր Շարժ
        </h3>
    </div>
    <hr>

    <table id="logs">
        <tr>
            <th>Հաճախորդ</th>
            <th>Ամսաթիվ</th>
            <th>Տեսակ</th>
            <th>Փոփոխել</th>
        </tr>
        @foreach($clientLogs as $log)
            {{--            {{var_dump($log)}}--}}
            <tr id="client_{{$log['log_id']}}">
                <input id="log-id" type="hidden" value="{{$log['log_id']}}">
                <td class="name">{{$log['m_name'] . ' '. $log['s_name']}}</td>
                <td class="surName">{{$log['current_date_today']}}</td>
                <td class="name">{{$log['g_name']}}</td>
                <td style="width: 5%">
                    <i class="fa fa-trash ml-4 options delete-log" data-toggle="modal" data-target="#delModal"></i>
                </td>
            </tr>
        @endforeach
    </table>
    <div>
        {{ $clientLogs->links() }}
    </div>

    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="delModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <input id="delete-modal-log-id" type="hidden" value="">
                        <h3>Ցանկանում եք հեռացնե՞լ </h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-header">
                        <h3 id="client-delete-modal-name"></h3>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button id="delete-log" type="button" class="btn btn-success" data-dismiss="modal">Այո
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Ոչ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>
