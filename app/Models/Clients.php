<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Clients extends Model
{
    use HasFactory;
    protected $table = 'clients';

    public static function getAllClientasArray ()
    {
        return Clients::orderBy('name','ASC')->simplePaginate(20);
    }

    public static function getClientByIdArray ($lastEnteredClientId)
    {
       $client =  Clients::find($lastEnteredClientId);
       return json_encode($client);
    }

    public static function updateClientProfileImagePath($clientId, $imgNewPath) {
        DB::update('update clients set picture_path = "'.$imgNewPath.'" where id = ?', [$clientId]);
    }

    public static function editClient ($client)
    {
        $clientId = $client['id'];
        $clientName = $client['name'];
        $clientSurname = $client['newSurname'];
        $clientIdNumber = $client['newIdNumber'];
        try {
            DB::update('update clients set name = "'.$clientName.'", surname = "'.$clientSurname.'", id_card_number = "'.$clientIdNumber.'" where id = ?', [$clientId]);
            $insert = true;
        } catch (\Illuminate\Database\QueryException $ex) {
            $insert = $ex->getMessage();
        }
        return $insert;
    }

    public static function createClient ($client)
    {
        $clientName = $client['name'];
        $clientSurname = $client['newSurname'];
        $clientIdNumber = $client['newIdNumber'];
        try {
            DB::insert('insert into clients (name, surname, id_card_number) values (?, ?, ?)', [$clientName, $clientSurname, $clientIdNumber]);
            $insert = true;
        } catch (\Illuminate\Database\QueryException $ex) {
            $insert = $ex->getMessage();
        }
        return $insert;
    }
}
