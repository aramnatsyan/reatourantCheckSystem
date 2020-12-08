<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    use HasFactory;

    private $clientCardNumber;
    private $tableName = 'clients';

    public static function checkClientEnter ($clientCardNumberParameter)
    {
        $clientCardNumber = $clientCardNumberParameter;
        $client = DB::table('clients')->where('id_card_number', $clientCardNumber)->get();
        return json_encode($client);
    }

}
