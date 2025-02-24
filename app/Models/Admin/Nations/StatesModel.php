<?php

namespace App\Models\Admin\Nations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatesModel extends Model
{
    use HasFactory;

    protected $table = 'states_tbl';

    static public function getRecord() {

        return self::select('states_tbl.*')->get();
        
    }


    static public function getRecordByCountry($country_id) {

        return self::select('states_tbl.*')
        ->where('states_tbl.country_id', '=', $country_id)
        ->get();
        // ->paginate(2);
        
    }
}
