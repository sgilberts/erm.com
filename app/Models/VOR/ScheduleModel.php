<?php

namespace App\Models\VOR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
    use HasFactory;
    
    protected $table = 'vor_schedule';

    static public function getAllSchedules() {

        return self::select('vor_schedule.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'vor_schedule.user_id')
                // ->where('vor_schedule.is_deleted', '=', 0)
                ->orderBy('vor_schedule.event_date', 'desc')
                ->get();
                // ->paginate(2);

    }


    
    static public function getScheduleById($id) {

        return self::select('vor_schedule.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'vor_schedule.user_id')
                ->where('vor_schedule.id', '=', $id)
                ->first();

    }

       
    static public function scheduleExists($eventTitle, $eventDate) {

        return self::select('vor_schedule.*', 'users.fname AS created_by_fname', 'users.lname AS created_by_lname')
                ->join('users', 'users.id', '=', 'vor_schedule.user_id')
                ->where('vor_schedule.event_title', '=', $eventTitle)
                ->where('vor_schedule.event_date', '=', $eventDate)
                ->first();

    }


}
