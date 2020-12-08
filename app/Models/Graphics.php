<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Graphics extends Model
{
    use HasFactory;

    public static function getAllGraphicsArray ()
    {
        $graphicsObject = Graphics::orderBy('start_time','ASC')->get();
        return json_decode($graphicsObject, true);
    }

    public static function createGraphic ($graphic)
    {
        $graphicName = $graphic['name'];
        $startTime = $graphic['newStartHour'] . ':' . $graphic['newStartMinute'] . ':00';
        $finishTime = $graphic['newFinishHour'] . ':' . $graphic['newFinishMinute'] . ':00';
        try {
            DB::insert('insert into graphics (graphic_name, start_time, finish_time) values (?, ?, ?)', [$graphicName, $startTime, $finishTime]);
            $insert = true;
        } catch (\Illuminate\Database\QueryException $ex) {
            $insert = $ex->getMessage();
        }
        return $insert;
    }

    public static function editGraphic ($graphic)
    {
        $graphicId = $graphic['id'];
        $graphicName = $graphic['name'];
        $startTime = $graphic['newStartHour'] . ':' . $graphic['newStartMinute'] . ':00';
        $finishTime = $graphic['newFinishHour'] . ':' . $graphic['newFinishMinute'] . ':00';
        try {
            DB::update('update graphics set graphic_name = "'.$graphicName.'", start_time = "'.$startTime.'", finish_time = "'.$finishTime.'" where id = ?', [$graphicId]);
            $insert = true;
        } catch (\Illuminate\Database\QueryException $ex) {
            $insert = $ex->getMessage();
        }
        return $insert;
    }

    public static function getCurrentGraphic ()
    {
        $currentTime = date("H:i:s");

        $graphic = DB::select("SELECT * FROM graphics WHERE start_time < CAST(? AS time) AND finish_time > CAST(? AS time)",[$currentTime, $currentTime]);
        return json_encode($graphic);
    }

    public static function getGraphicById ($graphicId)
    {

        $graphic = Graphics::find($graphicId);
        return json_encode($graphic);
    }
}
