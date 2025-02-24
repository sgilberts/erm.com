<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalEventTitleModel extends Model
{
    use HasFactory;

    protected $table = 'event_title_tbl';

    static public function getRecord() {

        $mySql =  self::select('event_title_tbl.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'event_title_tbl.user_id')
                ->orderBy('event_title_tbl.event_title', 'asc')
                ->get();
                

        return $mySql;

    }


    static public function getSingle($id) {

        return self::find($id);

    }
}
