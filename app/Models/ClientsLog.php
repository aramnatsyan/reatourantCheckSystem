<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientsLog extends Model
{
    use HasFactory;
    protected $table = 'clientlogs';

    public static function CheckClientActivityToday ($clientId, $graphicId)
    {
        $todayDate = date("Y-m-d");
        $log = DB::select("SELECT * FROM clientlogs WHERE client_id = ? AND craphic_id = ? AND current_date_today = ? ", [$clientId, $graphicId, $todayDate]);
        return json_encode($log);
    }

    public static function getLastEnteredClient ()
    {
        $lastEnteredClientID = DB::select("SELECT * FROM clientlogs ORDER BY id DESC LIMIT 1 ");
        return json_encode($lastEnteredClientID);
    }

    public static function getAllClientsLogsArray ()
    {
        return ClientsLog::leftJoin('clients','clientlogs.client_id','=','clients.id')
            ->leftJoin('graphics','clientlogs.craphic_id','=','graphics.id')
            ->select('clientlogs.*','clients.name as m_name','clients.surname as s_name', 'graphics.graphic_name as g_name', 'clientlogs.id as log_id')->orderBy('name','ASC')->simplePaginate(20);
    }

    public static function addClientsLog ($clientId, $graphicId)
    {
        try {
            DB::insert('insert into clientlogs (client_id, current_date_today, craphic_id) values (?, ?, ?)', [$clientId, date('Y-m-d'), $graphicId]);
            $insert = true;
        } catch (\Illuminate\Database\QueryException $ex) {
            $insert = $ex->getMessage();
        }
        return $insert;
    }
}
