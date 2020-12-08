<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\ClientsLog;
use Illuminate\Http\Request;

class ClientsLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = ClientsLog::getAllClientsLogsArray();
        return view('logs.logs')->with('clientLogs', $logs);
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
     * @param  \App\Models\ClientsLog  $clientsLog
     * @return \Illuminate\Http\Response
     */
    public function show(ClientsLog $clientsLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientsLog  $clientsLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientsLog $clientsLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientsLog  $clientsLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientsLog $clientsLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientsLog  $clientsLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientsLog $clientsLog)
    {
        $deleted = false;
        if (!empty($_POST)) {
            $logId = $_POST['logId'];
            if ($logId) {
                $deleted = ClientsLog::where('id', $logId)->delete();
            }
        }
        return $deleted;
    }

    public function addClientActivityToLogs(Request $request)
    {
        if ($request->has('clientId') && $request->has('graphicId')) {
            $clientId = $request['clientId'];
            $graphicId = $request['graphicId'];
           ClientsLog::addClientsLog($clientId, $graphicId);
        }
    }
}
