<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class CalendarModel extends Model
{
    use HasFactory;
    
    protected $table = 'eventcalendartbl';

    static public function getRecord() {

        $mySql =  self::select('eventcalendartbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'eventcalendartbl.user_id')
                ->orderBy('eventcalendartbl.id', 'asc')
                ->get();
                

        return $mySql;

    }



    static public function getEventDatesById($id) {

        $mySql =  self::select('eventcalendartbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'eventcalendartbl.user_id')
                ->where('eventcalendartbl.event_title_id', '=', $id)
                ->orderBy('eventcalendartbl.start', 'desc')
                ->get();
                

        return $mySql;

    }


    static public function getSingle($id) {

        return self::find($id);

    }

}
