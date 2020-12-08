<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\ClientsLog;
use App\Models\Graphics;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastEnteredClientData = '';
        $enteredDay = '';
        $graphicName = '';
        $lastEnteredClient = ClientsLog::getLastEnteredClient();
        if (!empty(json_decode($lastEnteredClient, true))) {
            $lastEnteredDate = json_decode($lastEnteredClient, true);
            $enteredDay = $lastEnteredDate[0]["current_date_today"];
            $graphicId = $lastEnteredDate[0]["craphic_id"];
            $graphic = Graphics::getGraphicById($graphicId);
            $graphicName = json_decode($graphic, true)['graphic_name'];
            $lastEnteredClientId = json_decode($lastEnteredClient, true)[0]['client_id'];
            $lastEnteredClientData = Clients::getClientByIdArray($lastEnteredClientId);
        }
        return view('home')->with(['lastEnteredClient' => json_decode($lastEnteredClientData, true), 'lastEnterDay' => $enteredDay, 'graphic' => $graphicName]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function checkClientEnter(Request $request) {
        if (!empty($request['clientCardNumber'])){
            $massage = '';
            $clientId = '';
            $graphicId = '';
            $clientCardNumber = $request['clientCardNumber'];
            $clientData = Home::checkClientEnter($clientCardNumber);
            if ($clientData == '[]'){
                $massage = 'Client not exists!';
            }
            else {
                $clientDataArray = json_decode($clientData, true)[0];
                $clientId = $clientDataArray['id'];
                if (!empty($clientId)) {
                    $graphic = Graphics::getCurrentGraphic();
                    if ($graphic == '[]') {
                        $massage = 'Can`t find graphics';
                    }
                    else {
                        $graphicDataArray = json_decode($graphic, true)[0];
                        $graphicId = $graphicDataArray['id'];
                        $log = ClientsLog::CheckClientActivityToday($clientId, $graphicId);
                        if ($log == '[]'){
                            $massage = 'Enter is Open';
                        }
                        else{
                            $massage = 'Client is already entered';
                        }
                    }
                }
                else {
                    $massage = 'Client exists but without ID';
                }
            }
            $data  = [
                'message' => $massage,
                'clientId' => $clientId,
                'graphicId' => $graphicId
            ];
            return json_encode($data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(Home $home)
    {
        //
    }
}
